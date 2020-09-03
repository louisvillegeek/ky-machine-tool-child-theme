/**
 * Inject methods and objects into the global space under
 * the EnfoldChild namespace to avoid conflicts
 */
export class EnfoldChildVisibility {

    /**
     * The namespace to inject methods and objects onto
     * @type {string}
     */
    private static namespace = "EnfoldChild";

    /**
     * Initializes the namespace
     */
    public static initialize() {
        window[this.namespace] = {};
    }

    /**
     * Adds a function, class, or object to the global scope under
     * the default namespace
     * @param name The property name to inject under
     * @param object The object to inject
     */
    public static add(name: string, object: any) {
        window[this.namespace][name] = object;
    }

}
