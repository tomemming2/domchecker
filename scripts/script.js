function fixme(element) {
    var val = element.value;
    var pattern = new RegExp('[ ]+', 'g');
    val = val.replace(pattern, '');
    element.value = val;
}

