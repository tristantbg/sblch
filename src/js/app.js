/* jshint esversion: 6 */

import lazysizes from 'lazysizes'
import optimumx from 'lazysizes'
require('../../node_modules/lazysizes/plugins/object-fit/ls.object-fit.js')
require('../../node_modules/lazysizes/plugins/unveilhooks/ls.unveilhooks.js')
import Flickity from 'flickity'
import MenuSpy from 'menuspy'
import jump from 'jump.js'
import BadgerAccordion from 'badger-accordion'
import ggmapStyles from './ggmap-styles'
import loadGoogleMapsApi from 'load-google-maps-api'
import 'cookieconsent'
require('viewport-units-buggyfill').init()

const _root = ''

const easeInOutExpo = (t, b, c, d) => {
  if (t == 0) return b
  if (t == d) return b + c
  if ((t /= d / 2) < 1) return c / 2 * Math.pow(2, 10 * (t - 1)) + b
  return c / 2 * (-Math.pow(2, -10 * --t) + 2) + b
}

const simulateClick = function(elem) {
  // Create our event (with options)
  var evt = new MouseEvent('click', {
    bubbles: true,
    cancelable: true,
    view: window
  });
  // If cancelled, don't dispatch our event
  var canceled = !elem.dispatchEvent(evt);
};

const App = {
  init: () => {
    App.ggmap()
    App.interact.init()
    App.cookieconsent()
    document.getElementById("loader").style.display = "none"

  },
  cookieconsent: () => {
    window.cookieconsent.initialise({
      container: document.getElementById("container"),
      "palette": {
        "popup": {
          "background": "#182a47",
          "text": "#ffffff"
        },
        "button": {
          "background": "#182a47",
          "text": "#ffffff"
        }
      },
      "theme": "edgeless",
      "position": "top",
      "content": {
        "message": "En poursuivant votre navigation sur ce site, vous acceptez l’installation et l’utilisation de cookies qui permet d'en mesurer l’audience.",
        "dismiss": "ACCEPTER",
        "link": "En savoir plus",
        "href": "http://www.reineblanche.com/pages/mentions-legales"
      }
    })
  },
  menu: {
    isOpened: false,
    init: () => {
      const menuBtn = document.querySelectorAll('[event-target=menu]')

      for (var i = 0; i < menuBtn.length; i++) {
        menuBtn[i].addEventListener('click', e => {
          if (App.menu.isOpened) {
            App.menu.off()
          } else {
            App.menu.on()
          }
        })
      }

      const menu = document.getElementById('menu-desktop')

      menu.addEventListener('mouseleave', App.menu.off)

    },
    on: () => {
      document.body.classList.add('menu-open')
      App.menu.isOpened = true
    },
    off: () => {
      document.body.classList.remove('menu-open')
      App.menu.isOpened = false
    }
  },
  interact: {
    init: () => {
      App.menu.init()
      App.interact.eventTargets()
      App.interact.embedKirby()
      App.interact.linkTargets()
      App.interact.navigation()
      App.interact.accordions()
      App.interact.sliders()
    },
    eventTargets: () => {
      const top = document.querySelectorAll('[event-target=top]')

      for (var i = 0; i < top.length; i++) {
        top[i].addEventListener('click', e => {
          e.preventDefault()
          jump('body', {
            duration: 1000,
            offset: 0,
            easing: easeInOutExpo,
          })
        })
      }
    },
    navigation: () => {
      const menu = document.getElementById('sections-navigation')
      if (!menu) return
      App.interact.navigation.element = new MenuSpy(menu)

      const links = menu.querySelectorAll('a')

      if (links) {
        for (var i = 0; i < links.length; i++) {
          links[i].addEventListener('click', e => {
            e.preventDefault()
            jump(e.currentTarget.getAttribute('href'), {
              duration: 1000,
              offset: 0,
              easing: easeInOutExpo,
            })
          })
        }
      }
    },
    sliders: () => {
      const sliders = document.getElementsByClassName('slider')

      for (var i = 0; i < sliders.length; i++) {
        const flkty = Flickity.data(sliders[i])

        flkty.on('staticClick', function(event, pointer, cellElement, cellIndex) {
          if (!cellElement || event.target.tagName.toLowerCase() === 'a' || event.target.tagName.toLowerCase() === 'img') {
            return;
          } else {
            this.next();
          }
        });
      }
    },
    accordions: () => {
      const accordions = document.querySelectorAll('.js-badger-accordion');

      Array.from(accordions).forEach((accordion) => {
        const ba = new BadgerAccordion(accordion, {
          openHeadersOnLoad: false
        });
      });

      const hash = window.location.hash
      if (hash) {
        const target = document.querySelector(hash + '.sub-section .js-badger-accordion-header')
        if (target) simulateClick(target)
      }
    },
    linkTargets: () => {
      const links = document.querySelectorAll("a");
      for (var i = 0; i < links.length; i++) {
        const element = links[i];
        if (element.getAttribute('target') === null) {
          if (element.host !== window.location.host) {
            element.setAttribute('target', '_blank');
          } else {
            element.setAttribute('target', '_self');
          }
        }
      }
    },
    embedKirby: () => {
      var pluginEmbedLoadLazyVideo = function() {
        var wrapper = this.parentNode;
        var embed = wrapper.children[0];
        var script = wrapper.querySelector('script');
        embed.src = script ? script.getAttribute('data-src') + '&autoplay=1' : embed.getAttribute('data-src') + '&autoplay=1';
        wrapper.removeChild(this);
      };

      var thumb = document.getElementsByClassName('embed__thumb');

      for (var i = 0; i < thumb.length; i++) {
        thumb[i].addEventListener('click', pluginEmbedLoadLazyVideo, false);
      }
    },

  },
  ggmap: () => {
    let map = document.getElementById('map');
    if (!map) return;

    loadGoogleMapsApi({
      key: 'AIzaSyCv2xv5wP64O_OqB8z_qQqhUn9Z6ZNU9RM'
    }).then(function(googleMaps) {
      let a = {
          styles: ggmapStyles,
          zoom: 15,
          center: new googleMaps.LatLng(48.8867423, 2.359044400000016),
          mapTypeId: googleMaps.MapTypeId.ROADMAP,
          zoomControl: true,
          mapTypeControl: false,
          scaleControl: false,
          streetViewControl: false,
          rotateControl: false,
          fullscreenControl: false
        },
        c = new googleMaps.Map(map, a);
      let image = _root + '/assets/images/marker.png';
      let marker = new googleMaps.Marker({
        icon: image,
        map: c,
        position: new googleMaps.LatLng(48.8867423, 2.359044400000016)
      });
      marker.addListener('click', () => {
        window.open("https://goo.gl/maps/2CicqJEvZ4m");
      });
    }).catch(function(error) {
      console.error(error)
    })
  },
}

document.addEventListener("DOMContentLoaded", App.init);