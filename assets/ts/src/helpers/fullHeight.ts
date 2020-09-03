/**
 * @author Jason Gallavin
 * @updated 05/03/2016
 * @created 3/8/2016
 * @version 0.9
 */


/**
 * This is how you call the full height script. give it the selector for the footer and jquery to adjust the body size.
 * EnfoldChild.fullHeight("#socket", jQuery);
 * or
 * EnfoldChild.fullHeight("#socket");
 */



/**
 * Sets the footer to the bottom of the page if page height is less than the window
 * @param {string} footerSelector The footer of the page to move down
 * @param {jQuery} $ jQuery Object to use
 * @return {FullHeightHandle} The handle disable events with
 */
export function fullHeight(footerSelector : string, $ : JQueryStatic = jQuery)
{
    if(footerSelector == null)
        throw new Error("selector not given");

    if($ == null)
        throw new Error("jQuery not given and could not be found in the environment");

    let handle = new FullHeightHandle(footerSelector, $);
    handle.register();
    return handle;
}

/**
 * The handle to use for registering and de-registering the full height events
 */
class FullHeightHandle {

    /**
     * The event handler for the resize event
     */
    private resizeHandle;

    /**
     * construct the handler
     * @param footerSelector The selector of the element that will stick to the bottom of the screen
     * @param $ The jQuery Object to use
     */
    constructor(private footerSelector : string, private $ : JQueryStatic = jQuery) {}

    /**
     * Register the event handlers
     */
    public register() {
        this.$(window).load(() => {
            this.adjustFooterToScreen();
            this.resizeHandle = () => this.adjustFooterToScreen;
            this.$(window).on("resize",  this.resizeHandle);
        });
    }

    /**
     * Disable the event handlers
     */
    public unRegister() {
        this.$(window).off("resize",  this.resizeHandle)
    }

    /**
     * Positions the element to the bottom of the screen
     */
    protected adjustFooterToScreen() {
        let $body = this.$('body');
        $body.css("height", "");
        let windowHeight = this.$( window ).height() - 6 ;
        let bodyHeight = $body.outerHeight();

        if(bodyHeight < windowHeight)
            $body.css("height", windowHeight);
        let wpAdminOffset = parseInt(this.$('html').css('margin-top').replace("px", ""));
        if(wpAdminOffset != undefined && wpAdminOffset > 0)
            windowHeight -= (wpAdminOffset - 1);

        if(bodyHeight < windowHeight)
            this.$(this.footerSelector).css("position", "fixed").css("width", "100%").css("bottom", "0");
        else
            this.$(this.footerSelector).css("position", "static");
    }
}


