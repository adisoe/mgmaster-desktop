<div class="container">
  <div class="content-navigation">
    <div class="nav-icon">
      <a href="javascript:void(0);" id="First" class="navigation" data-id="$Navigation.First" title="First"><img width="35" src="mgmaster-desktop/css/images/first.png"/></a>
    </div>
    <div class="nav-icon">
      <a href="javascript:void(0);" id="Prev" class="navigation" data-id="$Navigation.Prev" title="Previous"><img width="35" src="mgmaster-desktop/css/images/prev.png"/></a>
    </div>
    <div class="nav-icon">
      <a href="javascript:void(0);" id="Next" class="navigation" data-id="$Navigation.Next" title="Next"><img width="35" src="mgmaster-desktop/css/images/next.png"/></a>
    </div>
    <div class="nav-icon">
      <a href="javascript:void(0);" id="Last" class="navigation" data-id="$Navigation.Last" title="Last"><img width="35" src="mgmaster-desktop/css/images/last.png"/></a>
    </div>
    <div class="right-navigation">
      <a class="icon-button" href="javascript:void(0);" id="add" title="New">
        <div class="nav-icon">
          <img width="35" src="mgmaster-desktop/css/images/add-active.png"/>
          <div class="nav-icon-text-right">New</div>
        </div>
      </a>
      <a class="icon-button" href="javascript:void(0);" id="edit" title="Edit">
        <div class="nav-icon">
          <img width="35" src="mgmaster-desktop/css/images/edit-active.png"/>
          <div class="nav-icon-text-right">Edit</div>
        </div>
      </a>
      <a class="icon-button" href="javascript:void(0);" id="delete" title="Delete">
        <div class="nav-icon">
          <img width="35" src="mgmaster-desktop/css/images/delete-active.png"/>
          <div class="nav-icon-text-right">Delete</div>
        </div>
      </a>
      <a class="icon-button" href="javascript:void(0);" title="Close">
        <div class="nav-icon">
          <img width="35" src="mgmaster-desktop/css/images/close.png"/>
          <div class="nav-icon-text-right">Close</div>
        </div>
      </a>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="content-data">
    <div class="fixed-table-container" id="tableFixHeader">
      <table class="table">
        <thead>
          <tr>
            <th></th>
            <% loop $listField %>
            <% if $ShowInList %>
            <th>$Label</th>
            <% end_if %>
            <% end_loop %>
          </tr>
        </thead>
        <tbody id="listData">
          <tr>
            <td></td>
            <% loop $listField %>
            <% if $ShowInList %>
            <td>Loading...</td>
            <% end_if %>
            <% end_loop %>
          </tr>
        </tbody>
      </table>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="filter">
    <form id="mainForm" autocomplete="off">
      <input type="hidden" id="Page" name="Page" value="$Filter.Page">
      <table class="table-filter">
        <tr>
          <td style="width: 5%;text-align: center;"><span class="label-blue">Filter</span></td>
          <td style="width: 12%;">
            <select id="FilterField1" class="field-style search" name="FilterField1">
              <% loop $listField %>
              <option <% if $Top.Filter.FilterField1 == $Name %>selected<% end_if %> value="$Name">$Label</option>
              <% end_loop %>
            </select>
          </td>
          <td style="width: 12%;">
            <select class="field-style search" name="FilterBy1">
              <option <% if $Filter.FilterBy1 == 'LIKE' %>selected<% end_if %> value="LIKE">Mengandung</option>
              <option <% if $Filter.FilterBy1 == '=' %>selected<% end_if %> value="="> = </option>
              <option <% if $Filter.FilterBy1 == '<=' %>selected<% end_if %> value="<="> <= </option>
              <option <% if $Filter.FilterBy1 == '<' %>selected<% end_if %> value="<"> < </option>
              <option <% if $Filter.FilterBy1 == '>=' %>selected<% end_if %> value=">="> >= </option>
              <option <% if $Filter.FilterBy1 == '>' %>selected<% end_if %> value=">"> > </option>
              <option <% if $Filter.FilterBy1 == '<>' %>selected<% end_if %> value="<>"> <> </option>
            </select>
          </td>
          <td colspan="3"><input type="text" class="field-style search" name="FilterValue1" value="$Filter.FilterValue1"></td>
        </tr>
        <tr>
          <td style="text-align: center;">
            <select name="FilterLink" class="field-style search">
              <option <% if $Filter.FilterLink == 'AND' %>selected<% end_if %> value="AND">AND</option>
              <option <% if $Filter.FilterLink == 'OR' %>selected<% end_if %> value="OR">OR</option>
            </select>
          </td>
          <td>
            <select class="field-style search" name="FilterField2">
              <% loop $listField %>
              <option <% if $Top.Filter.FilterField2 == $Name %>selected<% end_if %> value="$Name">$Label</option>
              <% end_loop %>
            </select>
          </td>
          <td>
            <select class="field-style search" name="FilterBy2">
              <option <% if $Filter.FilterBy2 == 'LIKE' %>selected<% end_if %> value="LIKE">Mengandung</option>
              <option <% if $Filter.FilterBy2 == '=' %>selected<% end_if %> value="="> = </option>
              <option <% if $Filter.FilterBy2 == '<=' %>selected<% end_if %> value="<="> <= </option>
              <option <% if $Filter.FilterBy2 == '<' %>selected<% end_if %> value="<"> < </option>
              <option <% if $Filter.FilterBy2 == '>=' %>selected<% end_if %> value=">="> >= </option>
              <option <% if $Filter.FilterBy2 == '>' %>selected<% end_if %> value=">"> > </option>
              <option <% if $Filter.FilterBy2 == '<>' %>selected<% end_if %> value="<>"> <> </option>
            </select>
          </td>
          <td colspan="3"><input type="text" class="field-style search" name="FilterValue2" value="$Filter.FilterValue2"></td>
        </tr>
        <tr>
          <td style="text-align: center;"><span class="label-blue">Order By</span></td>
          <td>
            <select class="field-style search" name="OrderField">
              <% loop $listField %>
              <option value="$Name" <% if $Top.Filter.OrderField == $Name %>selected<% end_if %>>$Label</option>
              <% end_loop %>
            </select>
          </td>
          <td>
            <select class="field-style search" name="OrderType">
              <option <% if $Top.Filter.OrderType == 'ASC' %>selected<% end_if %> value="ASC">ASC</option>
              <option <% if $Top.Filter.OrderType == 'DESC' %>selected<% end_if %> value="DESC">DESC</option>
            </select>
          </td>
          <td style="vertical-align: middle;font-size: 13px;"><% if $ActiveField %><input name='$ActiveField' value="1" class="search" type="checkbox"> Aktif<% end_if %></td>
          <td style="width:15%;text-align: right;"><span class="label-blue">Max Records</span></td>
          <td style="width:15%;"><input type="text" class="field-style search" value="<% if $Filter.Limit %>$Filter.Limit<% else %>50<% end_if %>" name="Limit"></td>
        </tr>
      </table>
    </form>
  </div>
  <div class="footer">
    <div>Founds: <span id="countFind">$Count</span></div>
  </div>
</div>
<div id="dialogMain" title="Master Barang" class="dialog-main">
  <div class="dialog-header">
    <div class="right-navigation">
      <a class="icon-button" href="javascript:void(0);" id="saveData" title="Save">
        <div class="nav-icon">
          <img width="35" src="mgmaster-desktop/css/images/save-active.png"/>
          <div class="nav-icon-text-right">Save</div>
        </div>
      </a>
      <a class="icon-button" href="javascript:void(0);" title="Back" id="close">
        <div class="nav-icon">
          <img width="35" src="mgmaster-desktop/css/images/back-active.png"/>
          <div class="nav-icon-text-right">Close</div>
        </div>
      </a>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="dialog-content">
    <form id="dataForm" autocomplete="off">
      <% loop $Form.Hidden %>
      $Field
      <% end_loop %>
      <fieldset class="fieldset-custom">
        <legend class="legend-blue">Id</legend>
        <div class="div50">
          <table class="table-form">
            <% loop $Form.Id %>
            <tr>$Field</tr>
            <% end_loop %>
          </table>
        </div>
      </fieldset>
      <fieldset class="fieldset-custom">
        <legend class="legend-blue">Detail</legend>
        <div class="div50">
          <table class="table-form">
            <% loop $Form.Left %>
            <tr>$Field</tr>
            <% end_loop %>
          </table>
        </div>
        <div class="div50">
          <table class="table-form">
            <% loop $Form.Right %>
            <tr>$Field</tr>
            <% end_loop %>
          </table>
        </div>
      </fieldset>
    </form>      
  </div>
</div>
<script>
  var loading = '';
  var id = 0;
  $(document).ready(function () {
    loading = $('#listData').html();
  });
  $(function () {
    $("#dialogMain").dialog({
      autoOpen: false,
      width: 600
    });
    $("#edit").on("click", function () {
      if (id === 0) {
        alert("Pilih data terlebih dahulu "+id);
      } else {
        $("#dialogMain").dialog("open");
        $.ajax({
          url: "{$Link}getonedatajson",
          data: {id: id},
          dataType: 'json',
          type: 'post',
          success: function (data) {
            console.log(data);
            $('form#dataForm').populate(data);
            $('.numeric').trigger('focus');
          }
        });
      }
    });
    $("#delete").on("click", function () {
      if (id === 0) {
        alert("Pilih data terlebih dahulu "+id);
      } else {
        if (confirm("Anda akan menghapus data ini?")) {
          $.ajax({
            url: "{$Link}deletedata",
            data: {id: id},
            type: 'post',
            success: function () {
              loadDataAjax();
              alert("Data berhasil dihapus");
            }
          });
        }
      }
    });
    $("#add").on("click", function () {
      $('form#dataForm').trigger('reset');
      //$('form#dataForm').find('input').val("");
      $("#dialogMain").dialog("open");
    });
    $("#close").on("click", function () {
      $("#dialogMain").dialog("close");
    });
    $('#saveData').click(function () {
      var valid = true;
      $.each($("#dataForm input"), function (index, value) {
        var cek = $(this).attr('required');
        if (!$(value).val() && cek === 'required') {
          valid = false;
        }
      });
      if (valid) {
        $.ajax({
          url: '{$Link}savedata',
          data: $('form#dataForm').serialize(),
          type: 'post',
          success: function (data) {
            loadDataAjax();
            alert("Data berhasil disimpan");
            $("#dialogMain").dialog("close");
          }
        });
      } else {
        alert("Harap isikan field yang wajib diisi!");
      }
      //$('form#dataForm').submit();
    });
  });
  $(document).delegate('tr.row_data', 'click', function () {
    id = $(this).data('id');
    if ($(this).css("background-color") === "rgb(255, 255, 0)") {
      id = 0;
      $(this).css("background-color", "white");
    } else {
      $(document).find('tr.row_data').css("background-color", "white");
      $(this).css("background-color", "yellow");
    }
  });
  $(document).on('change', '.search', function () {
    $('#Page').val(0);
    loadDataAjax();
  });
  $(document).on('click', '.navigation', function () {
    var id = $(this).attr('data-id');
    $('#Page').val(id);
    loadDataAjax();
  });

  var win;
  var browse_id;

  // ini fungsi menangkap return value (hasil) dari browse window
  // return value sebaiknya json format
  function setWindowResult(returnValue) {
    console.log(returnValue);
    //targetField.value = returnValue;
    //$('.inner').html(returnValue);
    window.focus();
    win.close();
    //alert(browse_id);
    $('#'+browse_id).val(returnValue.Column);
    //$('#shipperid').val(returnValue.id);
  }

  (function ($) {
    $('.input-browse').on('click', function () {
      var module = $(this).attr('data-module');
      browse_id = $(this).attr('id');
      win = window.open('browse/window/'+module, 'MyWindow', "menubar=0,toolbar=0,width=600,height=350");
    });
  })(jQuery);

  function loadDataAjax() {
    id = 0;
    $('form#dataForm').trigger('reset');
    $('#listData').html(loading);
    fixTable(document.getElementById('tableFixHeader'));
    $.ajax({
      url: '{$Link}search_ajax',
      data: $('#mainForm').serialize(),
      dataType: 'json',
      type: 'post',
      success: function (data) {
        var html = '';
        $.each(data.list_data, function (i, row) {
          html += '<tr class="row_data" data-id="' + row[0] + '">';
          html += '<td></td>';
          for (i = 0; i < row.length; i++) {
            if (i === 0) {
              html += '<td></td>';
            } else {
              html += '<td>' + row[i] + '</td>';
            }
          }
          html += '</tr>';
        });
        $('#listData').html(html);
        $('#countFind').html(data.count);
        $('.navigation').removeAttr('data-id');
        $('#First').attr('data-id', data.navigation.First);
        $('#Prev').attr('data-id', data.navigation.Prev);
        $('#Next').attr('data-id', data.navigation.Next);
        $('#Last').attr('data-id', data.navigation.Last);
        fixTable(document.getElementById('tableFixHeader'));
      }
    });
  }
  $(document).ready(function () {
    loadDataAjax();
  });
  $(document).on('focus', '.datepicker', function () {
    $(this).datepicker({
      dateFormat: "yy-mm-dd"
    });
  });
  $(document).on('focus', '.numeric', function () {
    $(this).autoNumeric('init');
  });
  $(document).on('change', '.numeric', function () {
    var clear = $(this).autoNumeric('get');
    $(this).parent().find('.clear').val(clear);
  });
</script>