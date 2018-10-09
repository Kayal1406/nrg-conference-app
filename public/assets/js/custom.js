$(document).ready(function(){
    $('.travel_required_date').hide();
    $('.market_sponsor').hide();
    $('.benefits').hide();
    $('.business_unit_sponsoring').hide();
    $('.support_items').hide();

    $(document).on('click', '.file-upload-block', function(){
      var file = $(this).parent().parent().parent().find('.file');
      file.trigger('click');
    });
    $(document).on('click', '.file-upload-btn', function(){
      var file = $(this).prev('.file');
      file.trigger('click');
    });
    $(document).on('change', '.file', function(){
      $(this).parent().find('.browse').html('<i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Add new file');
      $('.file-upload-label').show();
      $(this).parent().find('#filename').html('<strong>' + $(this).val().replace(/C:\\fakepath\\/i, '') + '</strong> file is added.');
    });

    $('div.alert').delay(3000).slideUp(300);
    var base_url = APP_URL+'/';

    $('body').on('click', '.relativeSearch', function()
    {   
        var id = $(this).attr("id");
        var name = $(this).attr("name");
        $("#conid").val(id);
        var relConfHTML = '';
        $.ajax(
        {
            url: base_url+"relativesearch",
            type: "POST",
            data: {"id": id, "name": name},
            success: function (data)
            {
                if (!$.trim(data)) {
                    if (confirm("Are you sure you want to approve this conference?")){
                        window.location.href = base_url+"approveform/"+id;
                        }
                        return false;
                    } else {
                $.each(data,function(key, val){
                    console.log(key+ "--> "+ val);
                    relConfHTML += "<tr>";
                    relConfHTML += "<td><a href='conference_details/"+val.id+"' target='_blank'>"+val.conferencename+"</a></td>"; 
                    relConfHTML += "<td>"+val.status_sm+"</td>"; 
                    relConfHTML += "</tr>";
                });
                $('tbody.relconfhtml').html(relConfHTML);
                $('#relativeSearch').modal('show');
                return false;
                }
            }
        });
    });

    $('body').on('keyup', 'input, textarea', function()
    {
        var inputVal = $(this).val();
        if($.trim(inputVal).length == "")
        {
            $(this).val('');
        }
    });

    // Content container full height
    setContentHeight();


    $(window).resize(function(){
        setContentHeight();
    });

$(document).ready(function(){   
    $.ajax(
    {
        type : 'GET',
        url: base_url+"/getrelateduser",
        success: function (data)
        {
            // Defining the local dataset
            var relateduser = data;
            
            // Constructing the suggestion engine
            var relateduser = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: relateduser
            });
            $('.sendleads').typeahead({
                hint: true,
                highlight: true, /* Enable substring highlighting */
                minLength: 3, /* Specify minimum characters required for showing result */
            },
            {
                name: 'relateduser',
                source: relateduser
            });
        }
    });
});
$(document).ready(function (){
    $.extend(true, $.fn.dataTable.defaults, {
    columnDefs: [
        {
            targets: '_all',
            defaultContent: '-'
        }
        ]
    });
});

    $(document).ready(function(){   
        $.ajax(
        {
            type : 'GET',
            url: base_url+"/getrelatedconf",
            success: function (data)
            {
                // Defining the local dataset
                var relatedConf = data;
                
                // Constructing the suggestion engine
                var relatedConf = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: relatedConf
                });
                $('.typeahead').typeahead({
                    hint: true,
                    highlight: true, /* Enable substring highlighting */
                    minLength: 1 /* Specify minimum characters required for showing result */
                },
                {
                    name: 'relatedConf',
                    source: relatedConf
                });
            }
        });
    });  


    $('body').on('click', '.approve-reject', function() {    
        var conid = $("#conid").val();
        var conurlstatus = $(this).attr('id');
        switch(conurlstatus){
            case 'approve':
                window.location.href = base_url+"approveform/"+conid;
                break;

            case 'reject':
                window.location.href = base_url+"rejectform/"+conid;
                break;

            default:
                return false;         
        }
        
        return false;
    });


    $('.typeahead').on('typeahead:selected', function(evt, item) {
        $.ajax(
        {
            url: base_url+"conferenceExist",
            data: {"cname": item},
            success: function (data)
            {
                if(data){
                    var conInfoHTML = 'Entered conference <b>"'+data.conferencename+'"</b> is already <strong>'+data.status_sm+'</strong>';
                    $(".conferenceHTML").html(conInfoHTML);
                    $("#confrence-info").show('medium');                       
                }
                return false;
            }
        });

    });

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });


    $('body').on('click', '.change-status', function()
    {
        var id = $(this).attr("id");
        var $this = $(this);
        $.ajax(
        {
            url: base_url+"home/statuschange",
            data: {"id": id},
            success: function (data)
            {
                $this.toggleClass(function() {
                  if ( $this.is( ".btn-success" ) ) {
                    $this.html('Inactive').removeClass('btn-success');
                    return "btn-danger";
                  } else {
                    $this.html('Active').removeClass('btn-danger');
                    return "btn-success";
                  }
                });
                return false;
            }
        });
    });

    $('.support_needed').on('change',function(){ 
        if($(this).val() == 'Yes'){
            $('.support_items').show();
            $('#deliverables').attr("required", "true");
        }else{
            $('#deliverables').removeAttr("required");
            $('.support_items').hide();
        }
    });  

    $('.travel_req').on('change',function(){ 
        if($(this).val() == 'Yes'){
            $('.travel_required_date').show();
            $('#travelstart').attr("required", "true");
            $('#travelend').attr("required", "true");
        }else{
            $('#travelstart').removeAttr("required");
            $('#travelend').removeAttr("required");
            $('.travel_required_date').hide();
        }
    });   

    $('.sponsoring').on('change',function(){ 

        if($(this).is(':checked')){
            $('.market_sponsor').show();
            $('.benefits').show();
            $('#sponsor_needed').attr("required", "true");
            $('#sponsor_not_needed').attr("required", "true");
        }else{
            $('.market_sponsor').hide();
            $('.benefits').hide();
            $('#sponsor_needed').removeAttr("required");
            $('#sponsor_not_needed').removeAttr("required");
            $('#business').removeAttr("required");
            $('#benefits').removeAttr("required");
        }
    });  

    $('.sponsoring_unit').on('change',function(){ 
        if($(this).val() == 'No'){
            $('.business_unit_sponsoring').show();
            $('#business').attr("required", "true");
        }else{
            $('#business').removeAttr("required");
            $('.business_unit_sponsoring').hide();
        }
    }); 
});

function setContentHeight(){

        var windowHeight = $(window).outerHeight(true),
        headerHeight = $('header').outerHeight(true),
        contentHeight = $('.main-content > .container').outerHeight(true),
        totalContent = headerHeight + contentHeight;

        if(totalContent > windowHeight){
            $('.main-content > .container').height('auto');
        } else{
            $('.main-content > .container').height((windowHeight - headerHeight) - 60);
        }

    }