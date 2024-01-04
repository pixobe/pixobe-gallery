import r2wc from "@r2wc/react-to-web-component"
import App from "./App";

const WcApp = r2wc(App)

customElements.define("web-greeting", WcApp)