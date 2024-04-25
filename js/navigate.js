

    // Get references to the outer and inner links
    var innerLink1 = document.getElementById('innerLink1');

    
    // Add click event listener to the inner link to prevent the default behavior
    innerLink1.addEventListener('click', function(event) {
        var url = innerLink1.getAttribute('href');
        var url1 = innerLink1.getAttribute('data-link1-url');
        window.location.href = url1;
    });

    
    document.addEventListener('DOMContentLoaded', function() {
        var outerLink1 = document.getElementById('outerLink1');
    
        outerLink1.addEventListener('click', function(event) {
            var bioUrl1 = outerLink1.getAttribute('data-bio1-url');
            window.location.href = bioUrl1;
        });
    });
    
    
    // Get references to the outer and inner links
    // var outerLink1 = document.getElementById('outerLink1');
    var outerLink2 = document.getElementById('outerLink2');
    var outerLink3 = document.getElementById('outerLink3');
    var outerLink4 = document.getElementById('outerLink4');
    var outerLink5 = document.getElementById('outerLink5');
    var outerLink6 = document.getElementById('outerLink6');
    var outerLink7 = document.getElementById('outerLink7');
    var outerLink8 = document.getElementById('outerLink8');
    var outerLink9 = document.getElementById('outerLink9');
    var outerLink10 = document.getElementById('outerLink10');
   
    
    
    // Add click event listener to the outer link
    // outerLink1.addEventListener('click', function(event) {
    //     var bioUrl1 = outerLink1.getAttribute('data-bio1-url');
    //     window.location.href = bioUrl1;
    // });

    outerLink2.addEventListener('click', function(event) {
        var bioUrl2 = outerLink2.getAttribute('data-bio2-url');
        window.location.href = bioUrl2;
    });

    outerLink3.addEventListener('click', function(event) {
        var bioUrl3 = outerLink1.getAttribute('data-bio3-url');
        window.location.href = bioUrl3;
    });



    outerLink4.addEventListener('click', function(event) {
        var bioUrl4 = outerLink4.getAttribute('data-bio4-url');
        window.location.href = bioUrl4;
    });

    outerLink5.addEventListener('click', function(event) {
        var bioUrl5 = outerLink5.getAttribute('data-bio5-url');
        window.location.href = bioUrl5;
    });

    outerLink6.addEventListener('click', function(event) {
        var bioUrl6 = outerLink6.getAttribute('data-bio6-url');
        window.location.href = bioUrl6;
    });



    outerLink7.addEventListener('click', function(event) {
        var bioUrl7 = outerLink7.getAttribute('data-bio7-url');
        window.location.href = bioUrl7;
    });

    outerLink8.addEventListener('click', function(event) {
        var bioUrl8 = outerLink8.getAttribute('data-bio8-url');
        window.location.href = bioUrl8;
    });

    outerLink9.addEventListener('click', function(event) {
        var bioUrl9 = outerLink9.getAttribute('data-bio9-url');
        window.location.href = bioUrl9;
    });

    outerLink10.addEventListener('click', function(event) {
        var bioUrl10 = outerLink10.getAttribute('data-bio10-url');
        window.location.href = bioUrl10;
    });

   