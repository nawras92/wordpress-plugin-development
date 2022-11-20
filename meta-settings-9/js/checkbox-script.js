const form = document.getElementById('lwn-meta-form');
form.addEventListener('change', function (event) {
  if (event.target.name.startsWith('lwn-meta-show')) {
    event.target.value = event.target.value === 'yes' ? 'no' : 'yes';
  }
});
