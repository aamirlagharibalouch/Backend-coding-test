import React from 'react';
import "./bootstrap/bootstrap.min.css";


export default class Attendance extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      error: null,
      isLoaded: false,
      attendances: []
    };
  }

  componentDidMount() {
    fetch("http://localhost:9112/api/attendance")
      .then(res => res.json())
      .then(
        (result) => {
          this.setState({
            isLoaded: true,
            attendances: result
          });
        },
        (error) => {
          this.setState({
            isLoaded: true,
            error
          });
        }
      )
  }

  render() {
    const { error, isLoaded, attendances } = this.state;

    if (error) {
      return <div>Error: {error.message}</div>;
    } else if (!isLoaded) {
      return <div>Loading...</div>;
    } else {
      return (
      <div className="container-fluid mt-4">
        <table className="table table-bordered table-striped table-hover">
          <thead className="bg-dark text-light">
            <tr>
              <th>Name</th>
              <th>Check-In</th>
              <th>Check-Out</th>
              <th>Total Working Hours</th>
            </tr>
          </thead>
          <tbody>
            {attendances.map((item) => (
              <tr key={item.id}>
                <td>{item.employee}</td>
                <td>{item.check_in}</td>
                <td>{item.check_out}</td>
                <td>
                  <button className={`btn btn-${!isNaN(parseFloat(item.totalhours)) && item.totalhours <= 3 ? 'warning' : (item.totalhours == 'N/A' ? 'danger' : 'success')} me-2`}>
                    {item.totalhours} {item.totalhours > 0 ? 'Hours' : ''}
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    );
    }
  }
}