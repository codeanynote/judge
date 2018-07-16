(function ( $ ) 
{
   $.fn.printObject = function(params) 
   {
       var options = 
        {
            header: "",
            header_style: "",
            footer: "",
            footer_style: ""
        };

        $.extend(options, params);
        
        var header = "";
        var footer = "";
        
        if(options.header !== "" && options.header !== null && options.header !== 'undefined')
            header = "<div style=\""+options.header_style+"\">" + options.header + "</div>";
        
        if(options.footer !== "" && options.footer !== null && options.footer !== 'undefined')
            footer = "<div style=\""+options.footer_style+"\">" + options.footer + "</div>";
        
        var printWindow = window.open("", "_blank", "");
        var head = $("head").html();
        printWindow.document.open();
        printWindow.document.write('<html><head>'+head+'</head><body>');
        printWindow.document.write(header + $(this).html() + footer);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        
        setTimeout(function() 
        {
            printWindow.print();
            printWindow.close();
        }, 100);
   };
}( jQuery ));
