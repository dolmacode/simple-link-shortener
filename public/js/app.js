$('#store-link-submit').click(function() {
    let base_link = $('#store-link-base').val();
    
    $.ajax({
        url: '/api/link/store',
        method: 'post',
        data: { base_link: base_link },
        success: function(data){
            alert("Ваша ссылка: \n " + data);
            
            fillRecentLinks();
        }
    });
});

function fillRecentLinks() {
    $.ajax({
        url: '/api/link/recent',
        method: 'get',
        success: function(data) {
            var recentLinks = $('.recent-links');
            recentLinks.empty();

            $.each(data, function(index, element) {
                var link = $('<a>').attr('href', element.short_link).text('http://localhost:8000/' + element.short_link);
                var listItem = $('<li>').append(link);
                recentLinks.append(listItem);
            });
        }
    });
}
