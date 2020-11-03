window.addEventListener('load', function () {
   /* Privacy Controls verstecken */
   jQuery('#consent-in, #consent-out').hide()

   /* Cookie already set? */
   if (document.cookie.indexOf('cookieconsent_status=allow') > -1) {
      jQuery('#consent-out').show()
      onConsent()
   } else if (document.cookie.indexOf('cookieconsent_status=deny') > -1) {
      jQuery('#consent-in').show()
   } else {
      window.cookieconsent.initialise({
         position: 'bottom-right',
         content: {
            message: 'Diese Webseite verwendet Cookies und externe Dienste.',
            deny: 'Ablehnen',
            allow: 'OK',
            link: 'Mehr dazu',
            href: '/datenschutz/',
         },
         type: 'opt-in',
         elements: {
            dismiss:
               '<a aria-label="dismiss cookie message" role=button tabindex="0" class="cc-dismiss cc-btn button blue" data-icon-right="x">{{dismiss}}</a>',
            allow:
               '<a aria-label="allow cookies" role=button tabindex="0"  class="cc-btn cc-allow button" data-icon-right="x">{{allow}}</a>',
            deny:
               '<a aria-label="deny cookies" role=button tabindex="0" class="cc-btn cc-deny">{{deny}}</a>',
            //class cc-button needed
         },
         onStatusChange: function (status, chosenBefore) {
            var type = this.options.type
            var didConsent = this.hasConsented()
            if (type == 'opt-in' && didConsent) {
               // enable cookies
               onConsent()
            }
         },
      })

      jQuery('.button.cc-dismiss span').click(function () {
         jQuery(this).parent().click()
      })
   }

   jQuery('#consent-out').click(function (e) {
      e.preventDefault()
      consentOut()
   })
   jQuery('#consent-in').click(function (e) {
      e.preventDefault()
      consentIn()
   })
})

/* Functions 4 Privacy Controls */
function consentOut() {
   deleteAllCookies()
   document.cookie =
      'cookieconsent_status=deny; expires=Thu, 31 Dec 2199 23:59:59 UTC;path=/'
   if (
      !alert(
         'Alle Dienste für diese Webseite wurden in diesem Browser deaktiviert.',
      )
   ) {
      window.location.reload()
   }
}

function consentIn() {
   document.cookie =
      'cookieconsent_status=allow; expires=Thu, 31 Dec 2199 23:59:59 UTC;path=/'
   if (
      !alert(
         'Alle Dienste für diese Webseite wurden in diesem Browser aktiviert.',
      )
   ) {
      window.location.reload()
   }
}

function onConsent() {
   /* Google Analytics */

   console.log('Cookies allowed')
   var gaProperty = 'UA-XXXXXXXX-1'

   ;(function (i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r
      ;(i[r] =
         i[r] ||
         function () {
            ;(i[r].q = i[r].q || []).push(arguments)
         }),
         (i[r].l = 1 * new Date())
      ;(a = s.createElement(o)), (m = s.getElementsByTagName(o)[0])
      a.async = 1
      a.src = g
      m.parentNode.insertBefore(a, m)
   })(
      window,
      document,
      'script',
      '//www.google-analytics.com/analytics.js',
      'ga',
   )

   ga('create', gaProperty, 'auto')
   ga('set', 'anonymizeIp', true)
   ga('send', 'pageview')
}

function deleteAllCookies() {
   var cookies = document.cookie.split('; ')
   for (var c = 0; c < cookies.length; c++) {
      var d = window.location.hostname.split('.')
      while (d.length > 0) {
         var cookieBase =
            encodeURIComponent(cookies[c].split(';')[0].split('=')[0]) +
            '=; expires=Thu, 01-Jan-1970 00:00:01 GMT; domain=' +
            d.join('.') +
            ' ;path='
         var p = location.pathname.split('/')
         document.cookie = cookieBase + '/'
         while (p.length > 0) {
            document.cookie = cookieBase + p.join('/')
            p.pop()
         }
         d.shift()
      }
   }
   window.localStorage.clear()
}
