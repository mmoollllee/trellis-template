jQuery(document)
   .find('iframe[data-src]')
   .each(function () {
      var src = jQuery(this).attr('data-src')
      var src_name = jQuery(this).attr('data-src-name')
         ? jQuery(this).attr('data-src-name')
         : toLocation(src).hostname
      var message =
         'Diese Inhalte werden extern geladen von <i class="iframe-privacy--source">' +
         src_name +
         '</i>.<br />Durch das Aktivieren dieses Inhalts werden Daten wie Ihre IP-Adresse an den externen Server übertragen. Weitere Informationen entnehmen Sie bitte unserer <a href="/datenschutz/" title="Datenschutzerklärung lesen">Datenschutzerklärung</a>.'

      if (src_name == 'Vimeo') {
         var message =
            'Dieser Inhalt wird von <span class="iframe-privacy--source">Vimeo</span> geladen.<br/>Durch das Abspielen des Videos werden Daten wie Ihre IP-Adresse an Vimeo übertragen. Weitere Informationen entnehmen Sie bitte unserer <a href="/datenschutz/" title="Datenschutzerklärung lesen">Datenschutzerklärung</a>.'
      }

      var button =
         '<a class="button blue confirm" data-icon-right="f" data-src="' +
         src +
         '"><span>Inhalte laden</span></a>'

      if (src_name == 'Vimeo') {
         var button =
            '<a class="confirm play-button" data-icon-left="z" data-src="' +
            src +
            '"></a>'
      }

      jQuery(this)
         .attr('data-privacy-iframe', 'true')
         .wrap("<div class='iframe-privacy--wrapper'></div>")
         .parent()
         .prepend(
            '<div class="iframe-privacy--message">' +
               button +
               '<p class="font-80 font-sm-90">' +
               message +
               '</p></div>',
         )
   })

jQuery('.iframe-privacy--message a.confirm').click(function () {
   var parent = jQuery(this).parent()
   var src = jQuery(this).attr('data-src')
   parent.next().attr('src', src)
   parent.remove()
})

function toLocation(url) {
   var a = document.createElement('a')
   a.href = url
   return a
}
