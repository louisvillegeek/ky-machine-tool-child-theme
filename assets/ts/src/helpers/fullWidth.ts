/**
 * @author Jason Gallavin
 * @created 8/25/2015.
 * @updated 04/25/2017
 * @version 1.3
 * Fix: instant set to false now doesn't check for the element until the page is loaded
 * Purpose: Expands a child container to full page width. Very helpful for Wordpress projects.
 */

/**
 * Force an element to fill the width of the window.
 * @param {String} containerSelector The selector of the element to make full screen
 * @param {boolean} instant If set to true, the script will load instantly and not on document load
 * @param {JQueryStatic} $ The jQuery Object to use
 * @return {FullWidthHandle} A handle to deactivate the full width events
 */
export function fullWidth(containerSelector : string, instant : boolean = false, $ : JQueryStatic = jQuery) : FullWidthHandle
{
    if(containerSelector == null)
        throw new Error("fullWidth.js - container is undefined");
    let fullWidthObject = new FullWidthHandle(containerSelector, instant, $ );
    fullWidthObject.register();
    return fullWidthObject;
}


/**
 * The event handle that can be used to unregister the full width script
 */
class FullWidthHandle {

    /**
     * The load handler used to de-register later
     */
    private loadHandler;

    /**
     * The resize handler used to de-register later
     */
    private resizeHandler;

    constructor(private containerSelector : string, private instant : boolean = false, private $ : JQueryStatic = jQuery) {
        this.$(containerSelector).css('opacity', '0');
    }

    /**
     * Register the events
     */
    public register() {
        if(this.instant)
            this.onLoad();
        else {
            this.loadHandler =  () => this.onLoad();
            this.$(window).on("load",this.loadHandler);
        }

        this.resizeHandler = () => this.onResize();
        this.$(window).on("resize", this.resizeHandler);
    }

    /**
     * Disable the event handlers
     */
    public unRegister() {
        if(this.loadHandler)
            this.$(window).off("load", this.loadHandler);
        this.$(window).off("resize", this.resizeHandler)
    }

    /**
     * Resize the element to match the width of the screen
     */
    protected onLoad() {
        console.log("load");
        if( this.$(this.containerSelector).length == 0) {
            console.log(this.containerSelector + " is not found");
            return;
        }
        this.sizeElementToWindow();
        this.$(this.containerSelector).fadeTo(500, 1);
    }

    /**
     * Resize the element when the window re-sizes
     */
    protected onResize() {
        console.log("resizing");
        if(this.$(this.containerSelector).length == 0) {
            console.log(this.containerSelector + " is not found");
            return;
        }
        this.sizeElementToWindow();
    }

    /**
     * Resize the element to the window
     */
    protected sizeElementToWindow() {
        let width =  this.$(window).width();
        this.$(this.containerSelector).css('margin-left', "0");
        let left =  this.$(this.containerSelector).offset().left;
        this.$(this.containerSelector).css('margin-left', "-" + left + "px").css('width',width + "px").css('max-width', 'none');
    }

}


//Instantiate your object by selecting the element which you want to be full width. See below for an example.
//var myObject = new fullWidth(".kws_form", false);