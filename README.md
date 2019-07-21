# LJ Range Slider plugin for Craft CMS 3.x

An easy-to-use, flexible and responsive range slider for Craft CMS.

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Installation

You can install the plugin via the Craft Plugin Store.

## LJ Range Slider Overview

This plugin adds the following fieldtype:

- LJ Range Slider

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/1.png)

#### Simple start, basic params

Set min value, max value and start point.

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/2.png)

```
min: 100,
max: 1000,
from: 550
```

Set type to double, specify range, show grid and add a prefix "$".

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/3.png)

```
type: "double",
grid: true,
min: 0,
max: 1000,
from: 200,
to: 800,
prefix: "$"
```

#### Set up range and step

Set up range with negative values.

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/4.png)

```
type: "double",
grid: true,
min: -1000,
max: 1000,
from: -500,
to: 500
```

Force fractional values, using fractional step 0.1.

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/5.png)

```
type: "double",
grid: true,
min: -12.8,
max: 12.8,
from: -3.2,
to: 3.2,
step: 0.1
```

#### UI controls

Hide min and max labels

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/21.png)

```
min: 100,
max: 1000,
from: 550,
hide_min_max: true
```

Hide from and to labels

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/22.png)

```
min: 100,
max: 1000,
from: 550,
hide_min_max: true,
hide_from_to: true
```

#### Using array of custom values

When using custom values, FROM and TO should be zero-based index of values array. So in the example below 0=0, 1=10, 2=100, 3=1000, 4=10000 etc.

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/6.png)

```
type: "double",
grid: true,
from: 2,
to: 5,
values: [0, 10, 100, 1000, 10000, 100000, 1000000]
```

Values array could be anything, even strings.

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/7.png)

```
grid: true,
from: new Date().getMonth(),
values: [
    "Jan", "Feb", "Mar", "Apr", "May", "Jun",
    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
]
```

Same as above, but using Twig logic.


```
grid: true,
from: {{ now|date('n') - 1 }},
values: [
    "Jan", "Feb", "Mar", "Apr", "May", "Jun",
    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
]
```

#### Change visual look of numbers (prettify).

Improve readability of big numbers, like 1000000.

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/8.png)

```
grid: true,
min: 1000,
max: 1000000,
from: 100000,
step: 1000,
prettify_enabled: true,
prettify_separator: ","
```

#### Decorating numbers with prefixes, postfixes and other symbols.

Adding currency symbol and + symbol to the maximum number.

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/9.png)

```
grid: true,
min: 0,
max: 100,
from: 50,
step: 5,
max_postfix: "+",
prefix: "$"
```

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/10.png)

```
grid: true,
min: 0,
max: 100,
from: 50,
step: 5,
postfix: " €"
```

Using prefix and postfix at the same time.

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/11.png)

```
grid: true,
min: 0,
max: 100,
from: 21,
max_postfix: "+",
prefix: "Age: ",
postfix: " years"
```

#### Customising Grid

Divide the grid.

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/12.png)

```
grid: true,
min: 0,
max: 100,
from: 20,
grid_num: 4
```

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/13.png)

```
grid: true,
min: 0,
max: 100,
from: 20,
grid_num: 5
```

#### Callbacks

Using sliders callbacks.

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/19.png)

```
min: 0,
max: 5,
from: 3,
prefix: "Warp factor: ",
grid: true,
grid_num: 5,
onStart: function (data) {
    // fired when range slider is ready
},
onChange: function (data) {
    // fired on every range slider update
    
	if (data.from <= 4) {
		console.log("Scotty, we need more power!");
	} else {
		console.log("Captain, she cannae take anymore!");
	}
	
},
onFinish: function (data) {
    // fired on pointer release
}
```

#### Twig logic

The Slider Parameters field can use Twig logic and even Craft element queries.

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/20.png)

```
{% set values %}
    {% for i in currentUser.friendlyName|split('') %}
        "{{ i|upper }}"{{ not loop.last ? ',' }}
    {% endfor %}
{% endset %}

type: "double",
grid: true,
grid_num: {{ currentUser.friendlyName|length - 1 }},
values: [ {{ values }} ]
```

You can even fetch your Slider Parameters from a template.

```
{% include '_myRangeSliderParams' ignore missing %}
```

#### Skins

Big skin

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/14.png)

```
min: 100,
max: 1000,
from: 550,
skin: "big"
```

Modern skin

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/15.png)

```
min: 100,
max: 1000,
from: 550,
skin: "modern"
```

Sharp skin

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/16.png)

```
min: 100,
max: 1000,
from: 550,
skin: "sharp"
```

Round skin

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/17.png)

```
min: 100,
max: 1000,
from: 550,
skin: "round"
```

Square skin

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/18.png)

```
min: 100,
max: 1000,
from: 550,
skin: "square"
```

#### Additional Options

See the original [ion.rangeSlider](https://github.com/IonDen/ion.rangeSlider) project for additional options.

## Templating

"Single" Range Slider fields return a single FROM value.

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/2.png)

```
{{ entry.myRangeSliderField }}
// Prints something like: 550
```

"Double" Range Slider fields returns FROM and TO values, separated by ; character.

![Screenshot](https://raw.githubusercontent.com/lewisjenkins/craft-range-slider/master/resources/img/3.png)

```
{{ entry.myRangeSliderField }}
// Prints something like: 200;800

{% set myRangeSliderField = entry.myRangeSliderField|split(';') %}

{{ myRangeSliderField[0] }}
// 200

{{ myRangeSliderField[1] }}
// 800
```


---

This plugin is based on the [ion.rangeSlider](https://github.com/IonDen/ion.rangeSlider) plugin [[MIT licence](https://github.com/IonDen/ion.rangeSlider/blob/master/License.md)], with thanks to the original developer.

Brought to you by [Lewis Jenkins](https://lj.io).
