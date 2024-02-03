import React, { useState } from 'react';
import axios from 'axios';

function Excelupload({ onUploadComplete }) {
  const [file, setFile] = useState(null);

  const handleFileChange = (event) => {
    const selectedFile = event.target.files[0];
    setFile(selectedFile);
  };

  const handleUpload = async () => {
    try {
      const formData = new FormData();
      formData.append('file', file);

      // Make a POST request to the Laravel API route
      await axios.post('http://localhost:9112/api/upload-attendance', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });

      // Call the callback function to signal that the upload is complete
      onUploadComplete();
      alert('File uploaded successfully');
      setTimeout(function () {
        window.location.reload();
      }, 600);
            
    } catch (error) {
      console.error('Error uploading file', error);
    }
  };

  return (
    <div>
      <div className="form-group">
        <label>Upload CSV of Attendance sheet</label>
        <input type="file" className="form-control mb-2" onChange={handleFileChange} />
      </div>
      <button className="btn btn-info" onClick={handleUpload}>
        Upload File
      </button>
    </div>
  );
}

export default Excelupload;
