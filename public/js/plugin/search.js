/**
 * Created by msbomrel on 6/5/17.
 */
'use strict';
/* global instantsearch */
console.log("I am search js");
var search = instantsearch({
    appId: 'VMGLXCWP5H',
    apiKey: '0e872acc664b04284dc84facdd900e49',
    indexName: 'trips',
    urlSync :true,
    searchParameters:{
        query: document.getElementById('q').value
    }
});

var hitTemplate =
   '<div class="compare-item"><div class="compare-image  height-200"><a href="/{{slug}}" target="_blank"><img src="images/trips/{{cover_image}}" title="{{{name.value}}}"  /></a> <div class="compare-title"> <a href="/{{slug}}" target="_blank"><h3>{{{_highlightResult.name.value}}}</h3></a></div>  <div  class="compare-checkbox"><p><input title="Compare" class="filled-in compareCheckbox" type="checkbox" id="{{id}}" onchange="compareTo({{id}},this)"/>&nbsp;&nbsp;Compare</p></div></div> <div class="compare-wrapper"></div></div>';
   // <img src="images/Adventure-Sports.jpg" title="{{{name.value}}}"  />

var noResultsTemplate =
    '<div class="text-center">' +
    '<p>We didnot find any results for the search <span style="background:tomato;padding:2px 8px;"> {{query}} </span> </p>'+
    '</div>';

search.addWidget(
    instantsearch.widgets.searchBox({
        container: '#q'
    })
);

search.addWidget(
    instantsearch.widgets.stats({
        container: '#stats'
    })
);
search.addWidget(
    instantsearch.widgets.rangeSlider({
        container: '#price',
        attributeName: 'price',
        pips: false,
        min:0,
        /* min:0,
         max:15000,*/
        tooltips: {format: function(rawValue) {
            return '$' + parseInt(rawValue)}},
        templates:{
            /*header:getHeader('Price per trip'),*/
            header: 'PRICE PER TRIP'
        },
    })
);
search.addWidget(
    instantsearch.widgets.rangeSlider({
        container: '#altitude',
        attributeName: 'altitude',
        pips:false,
        tooltips: {format: function (rawValue) {
            return parseInt(rawValue)+'m';
        }},
        templates:{
            header: 'ELEVATION'
        },

    })
);



search.addWidget(
    instantsearch.widgets.rangeSlider({
        container: '#days',
        attributeName: 'days',
        pips: false,
        tooltips: {format: function(rawValue) {return parseInt(rawValue)}},
        templates:{
            header: 'DURATION'
        },

    })
);

search.addWidget(
    instantsearch.widgets.rangeSlider({
        container: '#physical_rating',
        attributeName: 'physical_rating',
        pips: false,
        tooltips: {format: function(rawValue) {return parseInt(rawValue)}},

        templates:{
            header:getHeader('Difficulty'),
        },
        collapsible: {
            collapsed: true // collapsed by default: true | false
        }

    })
);

search.addWidget(
    instantsearch.widgets.rangeSlider({
        container: '#poplularity',
        attributeName: 'poplularity',
        pips: false,
        tooltips: {format: function(rawValue) {return parseInt(rawValue)}},

        templates:{
            header:getHeader('Popularity')
        },
        collapsible: {
            collapsed: true // collapsed by default: true | false
        }

    })
);


search.addWidget(
    instantsearch.widgets.numericRefinementList({
        container: '#special_discount',
        attributeName: 'special_discount',
        label: 'Discount',
        options: [
            {name: 'All'},
            {start: 1, end: 15, name: 'Between (1 and 15)%'},
            {start: 15, name: 'More than 15%'}
        ],
        templates:{
            header:getHeader('Discount Range')
        },
        collapsible: {
            collapsed: true // collapsed by default: true | false
        }
    })
);




search.addWidget(
    instantsearch.widgets.menu({
        container: '#style',
        attributeName: 'style',
        limit: 10,
        operator: 'or',
        templates:{
            header:getHeader('styles')
        },

        collapsible: {
            collapsed: true // collapsed by default: true | false
        }

    })
);

search.addWidget(
    instantsearch.widgets.refinementList({
        container: '#start_location',
        attributeName: 'start_location',
        limit: 20,
        operator: 'or',

        templates:{
            header:getHeader('start location')
        },
        collapsible: {
            collapsed: true // collapsed by default: true | false
        }

    })
);

search.addWidget(
    instantsearch.widgets.refinementList({
        container: '#country',
        attributeName: 'country',
        limit: 10,
        operator: 'or',

        templates:{
            header:getHeader('country')
        },
        collapsible: {
            collapsed: true // collapsed by default: true | false
        }

    })
);

search.addWidget(
    instantsearch.widgets.refinementList({
        container: '#regions',
        attributeName: 'regions',
        limit: 10,
        operator: 'or',
        templates:{
            header:getHeader('regions'),
        },
        collapsible: {
            collapsed: true // collapsed by default: true | false
        }

    })
);


search.addWidget(
    instantsearch.widgets.refinementList({
        container: '#venture',
        attributeName: 'ventures',
        limit: 20,
        operator: 'or',

        templates:{
            header:getHeader('ACTIVITIES'),
        },
        collapsible: {
            collapsed: true // collapsed by default: true | false
        }

    })
);


search.addWidget(
    instantsearch.widgets.hits({
        container: '#hits',
        hitsPerPage: 21,
        pagination:true,
        templates: {
            empty: noResultsTemplate,
            item: hitTemplate
        }
    })
);

search.addWidget(
    instantsearch.widgets.pagination({
        container: '#pagination',
        scrollTo: '#results',
        showFirstlast:false,
        cssClasses: {
            root: 'pagination',
            active: 'active'
        }
    })
);

search.addWidget(
    instantsearch.widgets.sortBySelector({
        container: '#sort-by-price',
        cssClasses: {
            item: 'item-custom-css-class',
        },
        indices: [
            {name: 'trips', label: 'Price'},
            {name: 'trips_price_asc', label: 'Lowest Price'},
            {name: 'trips_price_desc', label: 'Highest Price'}
        ]
    })
);

search.addWidget(
    instantsearch.widgets.sortBySelector({
        container: '#sort-by-day',
        cssClasses: {
            item: 'item-custom-css-class',
        },
        indices: [
            {name: 'trips', label: 'Days'},
            {name: 'trips_days_asc', label: 'Low Duration'},
            {name: 'trips_days_desc', label: 'High Duration'}
        ]
    })
);
search.addWidget(
    instantsearch.widgets.clearAll({
        container: '#clear-all',
        templates: {
            link: '<i class="fa fa-eraser">clear</i>'
        },
        cssClasses: {
            root: 'waves-effect waves-light btn center'
        },
        autoHideContainer: true
    })
);


search.start();
/*please don't change this code... I Repeat... Don't change this code*/
function getHeader(title) {
    return `<h5>${title}</h5>`;
}



