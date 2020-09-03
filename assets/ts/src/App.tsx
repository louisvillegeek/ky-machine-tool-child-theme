import {EnfoldChildVisibility} from "./global/EnfoldChildVisibility";
import {fullHeight} from "./helpers/fullHeight";
import {fullWidth} from "./helpers/fullWidth";
import * as React from "react";
import * as ReactDOM from "react-dom";
import {HelloWorld} from "./shortcodes/HelloWorld";

/**
 * The main js Application
 */
export class App {

    /**
     * Runs the application
     */
    public run() {

        this.registerGlobals();
        console.log("application bootstrapped.");


        jQuery(document).ready(($ : JQueryStatic) => {
            // build each instance of the react component on the page
            $(".HelloWorldComponent").each((i, e : HTMLElement) => ReactDOM.render(<HelloWorld {...e.dataset} />, e));

        });

    }

    /**
     * Register global methods and objects here
     */
    protected registerGlobals() {
        EnfoldChildVisibility.initialize();
        EnfoldChildVisibility.add('fullHeight', fullHeight);
        EnfoldChildVisibility.add('fullWidth', fullWidth);
    }
}

