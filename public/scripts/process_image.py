from flask import Flask, request, jsonify
import cv2
import os
import json
import logging
from inference_sdk import InferenceHTTPClient

# Configure logging
logging.basicConfig(
    filename="debug.log",
    level=logging.INFO,
    format="%(asctime)s - %(levelname)s - %(message)s"
)

app = Flask(__name__)

def process_predictions(api_response):
    """Process and validate predictions from the API response."""
    predictions = []
    try:
        if isinstance(api_response, list) and len(api_response) > 0:
            # Get the first element of the list
            first_result = api_response[0]
            if "predictions" in first_result:
                predictions = first_result["predictions"]
            else:
                logging.warning("No 'predictions' key in the first result.")
        elif isinstance(api_response, dict) and "predictions" in api_response:
            predictions = api_response["predictions"]
        else:
            logging.warning("Unexpected response format from the API.")
    except Exception as e:
        logging.error(f"Error processing predictions: {str(e)}")
    return predictions

@app.route('/detect', methods=['POST'])
def detect():
    try:
        # Validate request
        if 'image' not in request.files:
            logging.error("No image uploaded in the request.")
            return jsonify({'error': 'No image uploaded'}), 400

        # Save uploaded image
        image_file = request.files['image']
        input_image_path = "/tmp/input_image.jpg"
        output_image_path = "/tmp/output_image.jpg"
        image_file.save(input_image_path)

        # Initialize Roboflow client
        api_key = os.getenv("ROBOFLOW_API_KEY", "EBUE3fpEIdWmz2dHPjn1")
        client = InferenceHTTPClient(
            api_url="https://detect.roboflow.com",
            api_key=api_key
        )

        # Call Roboflow API
        result = client.run_workflow(
            workspace_name="aller",
            workflow_id="custom-workflow",
            images={"image": input_image_path},
            use_cache=True
        )
        logging.info(f"Roboflow API raw response: {json.dumps(result)}")

        # Process predictions
        predictions = process_predictions(result)
        if not predictions:
            logging.warning("No valid predictions found in the API response.")
            return jsonify({"error": "No predictions found in the API response."}), 200

        # Annotate image with predictions
        img = cv2.imread(input_image_path)
        for prediction in predictions:
            if "class" in prediction and "x" in prediction and "y" in prediction:
                x, y, w, h = (
                    int(prediction['x'] - prediction['width'] / 2),
                    int(prediction['y'] - prediction['height'] / 2),
                    int(prediction['width']),
                    int(prediction['height'])
                )

                label = prediction['class']
                confidence = prediction.get('confidence', 0.0)

                # Draw bounding box and label
                cv2.rectangle(image, (x, y), (x + w, y + h), (0, 255, 0), 2)
                cv2.putText(
                    image, f"{label} ({confidence:.2f})",
                    (x, y - 10),
                    cv2.FONT_HERSHEY_SIMPLEX,
                    0.5,
                    (0, 255, 0),
                    2
                )
            else:
                logging.warning(f"Invalid prediction format: {json.dumps(prediction)}")

        # Save annotated image
        cv2.imwrite(output_image_path, image)
        return jsonify({
            "predictions": predictions,
            "annotated_image_path": "/tmp/output_image.jpg"
        }), 200

    except Exception as e:
        logging.error(f"Error in detect endpoint: {str(e)}")
        return jsonify({"error": str(e)}), 500

if __name__ == "__main__":
    app.run(host='0.0.0.0', port=5000)