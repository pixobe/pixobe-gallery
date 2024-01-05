import React from 'react';
import './App.css';
import PhotoAlbum from "react-photo-album";
import { getGallery, saveGallery } from './utils/rest-utils';
import { mapPhotos } from './utils/data-mapper';

declare const wp: any;

class PixobeGalleryAdmin extends React.Component<{ id: string }, { photos: Array<any> }> {

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


  /**
   * 
   * @param images 
   */
  onMediaSelect = (images: Array<any>) => {
    const photos = mapPhotos(images);
    this.setState({
      photos: photos
    });
  }

  componentDidMount = async () => {
    // This code will run after the component has been added to the DOM
    const media = this.media;

    // Load existing data
    const id = this.props.id;

    if (id) {
      const data = await getGallery(id);
      this.setState({
        photos: data
      })

    }


    media.on('select', () => {
      const items = media.state().get('selection').toJSON();
      // Log the selected attachment details
      const images = items.map(item => {
        const medium = item.sizes.medium;
        const full = item.sizes.full;
        return {
          id: item.id,
          title: item.title,
          sizes: item.sizes,
          medium: medium,
          full: full
        }
      });
      this.onMediaSelect(images);
    });
  }

  updateGallery = async () => {
    const { id } = this.props;
    const { photos } = this.state;
  
    await saveGallery(photos,id);
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

export default PixobeGalleryAdmin;
