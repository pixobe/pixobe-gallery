import React, { useRef } from 'react';
import printJS from 'print-js';

class ButtonControlsComponent extends React.Component<{ src: string, id: string, name: string }>{

  printImage = () => {
    const src = this.props.src;
    const name = this.props.name;
    if (src) {
      printJS({
        printable: src,
        type: 'image',
        header: name,
      })
    }
  }

  goToColoring = (e) => {
    const id = this.props.id;
    const imageUrl = `/pixobe-coloring?image_id=${id}`;
    e.preventDefault();
    window.location.href = imageUrl;
  }

  render() {
    return (
      <div className="controls">
        <button onClick={this.printImage}>Print</button>
        <button onClick={this.goToColoring}>Color</button>
      </div>
    );
  }
};


export default ButtonControlsComponent;