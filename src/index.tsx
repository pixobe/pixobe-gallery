import r2wc from "@r2wc/react-to-web-component";
import App from './App';
import Gallery from './Gallery';
import ButtonControls from './GalleryControls';


const GalleryAdminWc = r2wc(App,{
    props: {
      id: "number",
    },
  },)

customElements.define("pixobe-gallery-admin", GalleryAdminWc);


const GalleryWC = r2wc(Gallery,{
  props: {
    id: "number",
  },
},)

customElements.define("pixobe-gallery", GalleryWC);


const PixobeGalleryControls = r2wc(ButtonControls,{
  props: {
    src: "string",
    id:'string',
    name:'string'
  },
},)

customElements.define("gallery-controls", PixobeGalleryControls);