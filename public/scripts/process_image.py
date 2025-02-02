import sys
import cv2
import json
import os
from inference_sdk import InferenceHTTPClient


def main(image_path, output_path):
    # Check if the input image exists
    if not os.path.exists(image_path):
        print(json.dumps({"error": f"The image path {image_path} does not exist."}))
        return

    # Initialize the Roboflow client
    try:
        client = InferenceHTTPClient(
            api_url="https://detect.roboflow.com",  # Correct URL
            api_key="g15gPcsUoO4GsrnfaY7i"  # Correct API key
        )
    except Exception as e:
        print(json.dumps({"error": f"Failed to initialize InferenceHTTPClient: {str(e)}"}))
        return

    # Call the Roboflow workflow
    try:
        result = client.run_workflow(
            workspace_name="allercheck",  # Correct workspace name
            workflow_id="custom-workflow",  # Correct workflow ID
            images={"image": image_path},
            use_cache=True
        )
    except Exception as e:
        print(json.dumps({"error": f"Error calling Roboflow API: {str(e)}"}))
        return

    # Ensure the result format is valid
    if not isinstance(result, list) or len(result) == 0:
        print(json.dumps({"error": "Unexpected result format from API."}))
        return

    # Extract the first result and predictions
    first_result = result[0]
    predictions_data = first_result.get("predictions", {})

    # Check if predictions are present
    if "predictions" not in predictions_data:
        print(json.dumps({"error": "No predictions found in the API response."}))
        return

    predictions = predictions_data["predictions"]

    # Load the image using OpenCV
    image = cv2.imread(image_path)
    if image is None:
        print(json.dumps({"error": f"Failed to read the image {image_path} using OpenCV."}))
        return

    # Annotate the image with predictions
    for prediction in predictions:
        x, y, w, h = (
            int(prediction['x'] - prediction['width'] / 2),
            int(prediction['y'] - prediction['height'] / 2),
            int(prediction['width']),
            int(prediction['height'])
        )
        label = prediction['class']
        confidence = prediction['confidence']

        # Draw bounding box
        cv2.rectangle(image, (x, y), (x + w, y + h), (0, 255, 0), 2)

        # Add label and confidence
        cv2.putText(
            image, f"{label} ({confidence:.2f})",
            (x, y - 10),
            cv2.FONT_HERSHEY_SIMPLEX,
            0.5,
            (0, 255, 0),
            2
        )

    # Save the annotated image
    try:
        cv2.imwrite(output_path, image)
    except Exception as e:
        print(json.dumps({"error": f"Failed to save the annotated image: {str(e)}"}))
        return

    # Print predictions in the required format
    output = {
        "predictions": predictions,
        "annotated_image_path": output_path
    }

    print(json.dumps(output, indent=2))


if __name__ == "__main__":
    if len(sys.argv) != 3:
        print(json.dumps({"error": "Invalid number of arguments. Usage: python process_image.py <input_image_path> <output_image_path>"}))
    else:
        input_image = sys.argv[1]
        output_image = sys.argv[2]
        main(input_image, output_image)
