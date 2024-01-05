import React from 'react';
import './App.css';
import PhotoAlbum from "react-photo-album";
import { getGallery, saveGallery } from './utils/rest-utils';
import { mapPhotos } from './utils/data-mapper';

declare const wp: any;

class PixobeGalleryAdmin extends React.Component<{ id: string }, { photos: Array<any>, images: Array<any> }> {

  media = wp.media({ title: "Pixobe Gallery", multiple: "add" });

  constructor(props) {
    super(props);
    this.state = {
      photos: [],
      images: [],
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
      photos: photos,
      images: images
    });
  }

  componentDidMount = async () => {
    // This code will run after the component has been added to the DOM
    const media = this.media;

    // // Load existing data
    const id = this.props.id;

    if (id) {
      const data = await getGallery(id);

      const photos = mapPhotos(data);

      this.setState({
        photos: photos,
        images: data
      });

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
          medium: medium,
          full: full
        }
      });
      this.onMediaSelect(images);
    });
  }

  updateGallery = async () => {
    const { id } = this.props;
    const { images } = this.state;
    await saveGallery(images, id);
  }

  getShortcode = () =>{

    if(this.props.id){
       return <div>
        <h2>Shortcode</h2>
        <p><code>[pixobe-gallery id="{this.props.id}"]</code></p>
       </div>
    }
    return <div></div>
  }

  render() {
    const { photos } = this.state;

    return (
      <div>
        <div className="gallery">
          <PhotoAlbum layout="rows" photos={photos} />
        </div>
        <button onClick={this.uploadMedia}>Upload</button>
        <button onClick={this.updateGallery}>Save</button>
        {this.getShortcode()}
      </div>

    );
  }

}

export default PixobeGalleryAdmin;
