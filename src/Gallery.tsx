import React from 'react';
import './App.css';
import PhotoAlbum from "react-photo-album";
import { getGallery, saveGallery } from './utils/rest-utils';

declare const wp: any;

class PixobeGallery extends React.Component<{ id: string }, { photos: Array<any> }> {


    constructor(props) {
        super(props);
        this.state = {
            photos: [],
        };
    }

    async componentDidMount() {
        const id = this.props.id;
        try {
            // Perform asynchronous tasks here
            const data = await getGallery(id);
            console.log(data)
        } catch (error) {
            // Handle errors
            console.error('Error:', error);
        }
    }


    render() {
        const photos = this.state.photos;

        return (
            <div className="gallery">
                <PhotoAlbum layout="rows" photos={photos} />
            </div>
        );
    }

}

export default PixobeGallery;
