


/**
 * 
 * @param items 
 * @returns 
 */
export function mapPhotos(items: Array<any>) {

    return items.map(item=> {
        const image = item.medium || item.full;
         return {
             src: image.url,
             height: image.height,
             width: image.width
         }
    });
}