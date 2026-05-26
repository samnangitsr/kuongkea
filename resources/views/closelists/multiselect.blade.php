<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" tyle="text/css" href="{{ asset('public') }}/css/style.css">
    <link rel="stylesheet" tyle="text/css" href="{{ asset('public') }}/css/virtual-select.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <label for="">MultiSelect</label>
    <select id="multipleselect" multiple name="native-select" placeholder="Native Select" data-search="false" data-silent-initial-value-set="true">
        <option value="1" >Option 1</option>
        <option value="2">Option 2</option>
        <option value="3" >Option 3</option>
        ...
      </select>
      <button id="btngetvalue">Get Value</button>
</body>
<script src="{{ asset('public/js') }}/virtual-select.min.js"></script>

<script type="text/javascript">
    VirtualSelect.init({ 
    ele: '#multipleselect' 
  });
 
  $(document).ready(function () {
    $('#btngetvalue').click(function(e){
      e.preventDefault();
        var selvalue=$('#multipleselect').val();
        alert(selvalue)
    })
  })
</script>
</html>