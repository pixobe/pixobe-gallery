import r2wc from "@r2wc/react-to-web-component";
import App from './App';

const WebPhotoGallery = r2wc(App)

customElements.define("pixobe-gallery", WebPhotoGallery)

