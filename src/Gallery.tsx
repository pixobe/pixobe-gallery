import React from 'react';
import './App.css';
import PhotoAlbum from "react-photo-album";
import { getGallery, saveGallery } from './utils/rest-utils';

import Lightbox from "yet-another-react-lightbox";
import "yet-another-react-lightbox/styles.css";
import Fullscreen from "yet-another-react-lightbox/plugins/fullscreen";
import ButtonControls from './Controls';
import { mapPhotos } from './utils/data-mapper';


class PixobeGallery extends React.Component<{ id: string }, { photos: Array<any>, images: Array<any>, index: number }> {

    constructor(props) {
        super(props);
        this.state = {
            photos: [],
            index: -1,
            images: []
        };
    }

    async componentDidMount() {
        const id = this.props.id;
        try {
            // Perform asynchronous tasks here
            const images = await getGallery(id);
            const photos = mapPhotos(images);
            this.setState(
                {
                    photos,
                    images
                }
            )
        } catch (error) {
            // Handle errors
            console.error('Error:', error);
        }
    }

    setIndex(index) {
        this.setState({
            index
        })
    }

    render() {
        const photos = this.state.photos;
        const images = this.state.images;
        const index = this.state.index;
        return (
            <div className="gallery">
                <PhotoAlbum layout="masonry" photos={photos} columns={3}
                    targetRowHeight={150} onClick={({ index }) => this.setState({ index: index })} />
                <Lightbox
                    slides={photos}
                    open={index >= 0}
                    close={() => this.setIndex(-1)}
                    // enable optional lightbox plugins
                    plugins={[Fullscreen]}
                    index={this.state.index}
                    on={{
                        view: ({ index: currentIndex }) => this.setIndex(currentIndex),
                    }}
                    render={{
                        controls: () => ButtonControls(images[index])
                    }}
                />
            </div>
        );
    }

}

export default PixobeGallery;
