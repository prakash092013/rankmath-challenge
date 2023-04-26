import React from 'react'

function DisplayError(props) {
  return (
    <div className='error-message'>{props.message}</div>
  )
}

export default DisplayError