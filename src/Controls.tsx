import React, { useRef } from 'react';
import printJS from 'print-js';




class ButtonControlsComponent extends React.Component<{ photo: any }>{

  printImage = () => {
    const photo = this.props.photo;
    const imageUrl = photo.full.url;
    console.log(imageUrl)
    printJS({
      printable: imageUrl,
      type: 'image',
      header: photo.title,
    })
  }

  goToColoring = (e) => {
    const photo = this.props.photo;
    const imageUrl = `/pixobe-coloring?image_id=${photo.id}`;
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


const ButtonControls = (photo: any) => {
  return <ButtonControlsComponent photo={photo} />;
};


export default ButtonControls;