
/**
 * 
 * 
 */
export async function saveGallery(data:any) {

    const myNonce = 'your_generated_nonce';

    const relativeUrl = '?rest_route=/pixobe-gallery/v1/gallery';

    // Construct the absolute URL by combining the origin with the relative URL
    const apiUrl = `${window.location.origin}${relativeUrl}`;

    // Prepare the headers, including the nonce
    const headers = new Headers({
        'Content-Type': 'application/json',
        // 'X-WP-Nonce': myNonce,
    });

    // Make a GET request to the API endpoint
    fetch(apiUrl, { method: 'POST', headers, body: JSON.stringify(data) })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Handle the data returned by the API
            console.log('API Response:', data);
        })
        .catch(error => {
            // Handle errors
            console.error('Fetch Error:', error);
        });

}


/**
 * 
 * 
 */
export async function getGallery(index:string) : Promise<any> {

    const myNonce = 'your_generated_nonce';

    const relativeUrl = `?rest_route=/pixobe-gallery/v1/gallery/${index}`;

    // Construct the absolute URL by combining the origin with the relative URL
    const apiUrl = `${window.location.origin}${relativeUrl}`;

    // Prepare the headers, including the nonce
    const headers = new Headers({
        'Content-Type': 'application/json',
        // 'X-WP-Nonce': myNonce,
    });

    // Make a GET request to the API endpoint
    return fetch(apiUrl, { method: 'GET', headers })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Handle the data returned by the API
            return data;
        })
        .catch(error => {
            // Handle errors
            console.error('Fetch Error:', error);
        });

}