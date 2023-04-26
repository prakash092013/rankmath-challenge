import React from 'react';
import axios from 'axios';
import MyCharts from './MyCharts';
import DisplayError from './DisplayError';
import "./App.css";

class App extends React.Component {
  constructor(props) { 
    super(props); 
    this.state = {
      chartEndPoint: window.rankmath_inspector_dashboard.urls,
      chartData: [],
      errorMessage: '',
      loading: true,
    };

    this.fetchChartData = this.fetchChartData.bind(this)
  }

  /* Fetch default Graph for 1 week on component mount
   * action: set state for chart data points if success, else returns error message
  */
  componentDidMount(){

    axios.get( this.state.chartEndPoint[0] )
      .then( response => {
        // console.log(response)
        this.setState({
          chartData: response.data.pivots,
          loading: false
        })
      })
      .catch(error => {
        // console.log(error)
        this.setState({
          errorMessage: 'Error fetching the data',
          loading: false
        })
      })
  }

  /* Fetch Graph data from REST API endpoint
   * action: set state for chart data points if success, else returns error message
  */
  fetchChartData = event => {

    this.setState({ loading: true })

    let urlindex = event.target.value;
    axios.get( this.state.chartEndPoint[urlindex] )
      .then( response => {
        // console.log(response)
        this.setState({
          chartData: response.data.pivots,
          loading: false
        })
      })
      .catch(error => {
        // console.log(error)
        this.setState({
          errorMessage: 'Error fetching the data',
          loading: false
        })
      })
  }
  
  render() { 

    const { chartData, errorMessage, loading } = this.state
    return (
      <div className='rmi-widget-wrapper'>
        <div className='rmi-widget-header'>
          <h3>Graph Widget</h3>
          <div className='rmi-widget-header-right'>
            <div className='rmi-widget-loader'>{ loading ? <span className='spinner is-active'></span> : null }</div>
            <div className='rmi-widget-selectbox'>
              <select onChange={this.fetchChartData}>
                <option value="0">Last 7 days</option>
                <option value="1">Last 15 days</option>
                <option value="2">Last 1 Month</option>
              </select>
            </div>
          </div>
        </div>
        <div className='rmi-widget-content'>{ chartData.length ? <MyCharts pivots={chartData} /> : null }</div>
        <div className='rmi-widget-footer'>{ errorMessage ? <DisplayError message={errorMessage} /> : null }</div>
      </div>
    );
  }
}
export default App;