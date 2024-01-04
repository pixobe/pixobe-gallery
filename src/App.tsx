import React, { useState } from 'react';
import './App.css';
import PhotoAlbum from "react-photo-album";

declare const wp: any;
const breakpoints = [1080, 640, 384, 256, 128, 96, 64, 48];

class PixobeGallery extends React.Component<{}, { photos: Array<any> }> {

  media = wp.media({ title: "Pixobe Gallery", multiple: "add" });

  constructor(props) {
    super(props);
    this.state = {
      photos: [],
    };
  }


  // Event handler to increment the count when the button is clicked
  uploadMedia = () => {
    // The setCount function is used to update the state variable
    if (wp) {
      this.media.open();
    }
  };

  onMediaSelect = (images: Array<any>) => {
    this.setState({
      photos: images
    });
  }

  componentDidMount = () => {
    // This code will run after the component has been added to the DOM
    const media = this.media;
    media.on('select', () => {
      const items = media.state().get('selection').toJSON();
      // Log the selected attachment details
      const images = items.map(item => {
        const photo = item.sizes.medium || item.sizes.full;
        return {
          id: item.id,
          title: item.title,
          sizes: item.sizes,
          src: photo.url,
          width: photo.width,
          height: photo.height,
          srcSet: breakpoints.map((breakpoint) => {
            const height = Math.round((photo.height / photo.width) * breakpoint);
            return {
              src: photo.url,
              width: breakpoint,
              height,
            };
          }),
        }
      });
      this.onMediaSelect(images);
    });
  }

  render() {
    const { photos } = this.state;
    return (
      <div className="gallery">
        <button onClick={this.uploadMedia}>Upload</button>
        <PhotoAlbum layout="rows" photos={photos} />
      </div>
    );
  }

}

export default PixobeGallery;
