var bodyBlock = document.body;
var mapBlock = document.getElementById('map');
var listBlock = document.getElementById('demo');
var mapToggle = document.getElementById('mapToggle');
var listToggle = document.getElementById('listToggle');

function mapToggleFn() {
    if (mapToggle.classList.contains('active')) {
        if (listToggle.classList.contains('active')) {
            bodyBlock.classList.remove("map-on");
            mapToggle.classList.remove("active");
            //jQuery('#map').toggle('slide', 'left', 500);
        }
    } else {
        if (listToggle.classList.contains('active')) {
            bodyBlock.classList.add("map-on");
            mapToggle.classList.add("active");
            //jQuery('#map').toggle('slide', 'left', 500);
        }
    }
}
function listToggleFn() {
    if (listToggle.classList.contains('active')) {
        if (mapToggle.classList.contains('active')) {
            bodyBlock.classList.remove("list-on");
            listToggle.classList.remove("active");
            //jQuery('#demo').toggle('slide', 'left', 500);
        }
    } else {
        if (mapToggle.classList.contains('active')) {
            bodyBlock.classList.add("list-on");
            listToggle.classList.add("active");
            //jQuery('#demo').toggle('slide', 'left', 500);
        }
    }
}