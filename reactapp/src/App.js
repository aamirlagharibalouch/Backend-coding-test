import React, { useState } from 'react';
import logo from './logo.svg';
import './App.css';
import Attendance from './Attendance.js';
import Excelupload from './Excelupload.js';

function App() {
  const [shouldRenderAttendance, setShouldRenderAttendance] = useState(true);

  const handleUploadComplete = () => {
    // Set the state to control whether to render the Attendance component
    setShouldRenderAttendance(true);
  };

  return (
    <div>
      <table className="table">
        <tr>
          <td>
            <h2>AttendanceSYS</h2>
          </td>
          <td align="right">
            <Excelupload onUploadComplete={handleUploadComplete} />
          </td>
        </tr>
      </table>

      {shouldRenderAttendance && <Attendance />}
    </div>
  );
}

export default App;
