import * as React from "react";

interface HelloWorldProps {
 name?: string;
}

/**
 * Hello World Component
 */
export class HelloWorld extends React.Component<HelloWorldProps> {

    /**
     * say hello
     * @return {any}
     */
    render() {
        return (
            <h1>Hello {this.props.name}!</h1>
        );
    }
}