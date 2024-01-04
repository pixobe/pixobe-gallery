import React from 'react';
import './App.css';
import PhotoAlbum from "react-photo-album";
import { saveGallery } from './utils/rest-utils';

declare const wp: any;
const breakpoints = [1080, 640, 384, 256, 128, 96, 64, 48];

class PixobeGallery extends React.Component<{ id: string }, { photos: Array<any> }> {

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
          height: photo.height
        }
      });
      this.onMediaSelect(images);
    });
  }

  updateGallery = async () => {
    const { id } = this.props;
    const { photos } = this.state;

    const data = {
      id, images: photos
    }
    await saveGallery(data);
  }

  render() {
    const { photos } = this.state;

    return (
      <div className="gallery">

        <PhotoAlbum layout="rows" photos={photos} />
        <button onClick={this.uploadMedia}>Upload</button>
        <button onClick={this.updateGallery}>Save</button>
      </div>
    );
  }

}

export default PixobeGallery;
