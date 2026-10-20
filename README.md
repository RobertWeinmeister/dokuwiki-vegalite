# Vega-Lite Plugin for DokuWiki

This is a plugin for [DokuWiki](https://www.dokuwiki.org/dokuwiki). It provides support for the interactive graphing tool [Vega-Lite](https://vega.github.io/vega-lite/). Vega-Lite is a JavaScript based interactive graphing tool using  concise, declarative JSON syntax to create diagrams dynamically.

1. [Installation](#installation)
2. [Basic example](#basic-example)
3. [Further Functionality](#further-functionality)
4. [Configuration and Settings](#configuration-and-settings)
5. [Known Problems](#known-problems)
6. [License](#license)

## Installation

Install the plugin using the [Dokuwiki Plugin Manager](https://www.dokuwiki.org/plugin:plugin). Refer to [Plugins](https://www.dokuwiki.org/plugins|Plugins) on how to install plugins manually.

⚠️ The plugin requires PHP 8.0+ to function properly.

## Basic example

Provide the Vega-Lite data enclosed by the ```<vegalite>``` tags:

    <vegalite>
    {
        "$schema": "https://vega.github.io/schema/vega-lite/v6.json",
        "description": "A simple bar chart with embedded data.",
        "data": {
            "values": [
            {"a": "A", "b": 28}, {"a": "B", "b": 55}, {"a": "C", "b": 43},
            {"a": "D", "b": 91}, {"a": "E", "b": 81}, {"a": "F", "b": 53},
            {"a": "G", "b": 19}, {"a": "H", "b": 87}, {"a": "I", "b": 52}
            ]
        },
        "mark": "bar",
        "encoding": {
            "x": {"field": "a", "type": "nominal", "axis": {"labelAngle": 0}},
            "y": {"field": "b", "type": "quantitative"}
        }
    }
    </vegalite>

This will be rendered by the plugin and shown as:

![The diagram as provided by Vega-Lite](https://github.com/RobertWeinmeister/dokuwiki-vegalite/blob/main/example.png?raw=true)

Vega-Lite supports multiple other graphs besides the shown bar chart, for more examples and details on the Vega-Lite syntax, see <https://vega.github.io/vega-lite/examples/>.

## Further Functionality

### Size Adjustmens

The width and height of the container of the diagram can be adjusted using

    <vegalite #width #height>
    
where #width and #height can take any value supported by CSS, for example:

    <vegalite 100% 1cm>

This needs to be used in conjunction with

    "width": "container"
    "height": "container"

as part of the Vega-Lite data.

## Configuration and Settings

No further configuration is required.

### Version and Location

You can choose which Vega/Vega-Lite/Vega-Embed versions you want to use:

- The locally hosted versions (currently versions 6.4.0/6.5.0/7.3.0) or
- the remotely hosted, currently available, latest version.

## License

This project is licensed under the GNU General Public License v2.0. See the [LICENSE](LICENSE) file for details.

Vega, Vega-Lite and Vega-Embed are licensed under the BSD 3-Clause "New" or "Revised" License. See the [LICENSE VEGA](LICENSE%20LICENSE%20VEGA), [LICENSE VEGA-LITE](LICENSE%20LICENSE%20VEGA-LITE) and [LICENSE VEGA-EMBED](LICENSE%20LICENSE%20VEGA-EMBED) file for details.
