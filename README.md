filterByKey
===========

A plugin for Phile that adds a Twig function to filter a Page by a specific meta key

### 1.1 Installation (composer)

```
php composer.phar require phile/filterByKey:*
```

### 1.2 Installation (Download)

* Install [Phile](https://github.com/PhileCMS/Phile)
* Clone this repo into `plugins/phile/filterByKey`

### 2. Activation

After you have installed the plugin. You need to add the following line to your `config.php` file:

* add `$config['plugins']['phile\\filterByKey'] = array('active' => true);` to your `config.php`

### What Is This For?

I had a list of pages that only contained a *specific meta key* I wanted to iterate over. I also had to echo out a divider for each 3 items. I was going to use the [batch](http://twig.sensiolabs.org/doc/filters/batch.html) feature in Twig, but it required that my array was already sorted. So I needed a way to create a new array with only the pages that contained that specific meta key *and then* use batch on that new array.

This new Twig function allows you to filter an array of pages, into a new array of pages that only contains the meta key that you want. See the example below to see a real world use case.

#### Examples:

```twig
{# Give me a new array, but leave out pages that dont have meta.instructor_name #}
{% set team = filter_by_key(pages, 'instructor_name') %}

<div class="row">
{% for member in team %}
  <div class="col col-3">
    <a href="{{ member.url }}" title="{{ member.title }}">{{ member.meta.instructor_name }}</a>
  </div>
{% endfor %}
</div>
```

```twig
{# I only want an array that contains pages with 'Alt Data:' in the meta comment #}
{% set items = filter_by_key(pages, 'alt_data') %}

<table>
{% for row in items|batch(3, 'No item') %}
    <tr>
        {% for column in row %}
            <td>{{ column }}</td>
        {% endfor %}
    </tr>
{% endfor %}
</table>
```
