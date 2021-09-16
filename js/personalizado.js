document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var initialLocaleCode = 'pt-br';
  var calendar = new FullCalendar.Calendar(calendarEl, {
    height: '98vh',
    headerToolbar: {
      left: '',
      center: 'today prev title next datepicker',
      right: ''
    },
    titleFormat:{ 
      year: 'numeric', 
      month: 'short', 
      day: 'numeric' 
    }, 
    defaultDate: Date(),
    themeSystem: 'bootstrap',
    bootstrapFontAwesome:{
      datepicker:'fa fa-calendar'
    },
    initialView: 'timeGridDay',
    allDaySlot: false,
    slotMinTime:'08:00',
    slotMaxTime:'18:15',
    slotDuration: '00:15',
    slotLabelInterval:'00:15',
    slotLabelFormat:{
      hour: '2-digit',
      minute: '2-digit'
    },
    // slotLabelFormat:  '(HH:mm)',
    nowIndicator: true,
    editable: true,
    selectable: true,
    selectMirror: true,
    select: function(info){
      $('#cadastrar #start').val(moment(info.start).format('DD/MM/YYYY HH:mm'));
      $('#cadastrar #startdate').val(moment(info.start).format('DD/MM/YYYY'));
      $('#cadastrar #starttime').val(moment(info.start).format('HH:mm'));
      $('#cadastrar #endtime').val(moment(info.end).format('HH:mm'));
      $('#cadastrar #end').val(moment(info.end).format('DD/MM/YYYY HH:mm'));
      $('#cadastrar').modal('show');          
    },
    eventClick: function(info) {
      $("#apagar_evento").attr("href", "apagar_evento.php?id=" + info.event.id);
      $('#visualizar #id').text(info.event.id);
      $('#visualizar #id').val(info.event.id);
      $('#visualizar #title').text(info.event.title);
      $('#visualizar #title').val(info.event.title);
      $('#visualizar #startdata').val(moment(info.event.start).format('DD/MM/YYYY HH:mm'));
      $('#visualizar #enddata').val(moment(info.event.end).format('DD/MM/YYYY HH:mm'));
      $('#visualizar #start').text(moment(info.event.start).format('DD/MM/YYYY HH:mm'));
      $('#visualizar #end').text(moment(info.event.end).format('DD/MM/YYYY HH:mm'));
      $('#visualizar #starttime').text(moment(info.event.start).format('HH:mm'));
      $('#visualizar #starttime').val(moment(info.event.start).format('HH:mm'));
      $('#visualizar #startdate').text(moment(info.event.start).format('DD/MM/YYYY'));
      $('#visualizar #startdate').val(moment(info.event.start).format('DD/MM/YYYY'));
      $('#visualizar #endtime').text(moment(info.event.end).format('HH:mm'));
      $('#visualizar #endtime').val(moment(info.event.end).format('HH:mm'));
      $('#visualizar .procedimento').text(info.event.extendedProps.procedimento);
      $('#visualizar .procedimento').val(info.event.extendedProps.procedimento);
      $('#visualizar .tipoProcedimento').text(info.event.extendedProps.procedimento);
      $('#visualizar .tipoProcedimento').val(info.event.extendedProps.procedimento);
      $('#visualizar #color').val(info.event.color);        
      $('#visualizar #observacoes').text(info.event.extendedProps.observacoes);
      $('#visualizar #observacoes').val(info.event.extendedProps.observacoes);
      $('#visualizar #dentista_id').text(info.event.extendedProps.dentista_id);
      $('#visualizar #dentista_id').val(info.event.extendedProps.dentista_id);
      $('#visualizar').modal('show');
      return false;
    },
    // Salva o arraste das horas do evento
    eventResize : function(info) {
      console.log(info);
      var id = info.event.id;
      var dentista_id = info.event.dentista_id;
      var starttime= moment(info.event.start).format('HH:mm');
      var endtime= moment(info.event.end).format('HH:mm');
      var startdate= moment(info.event.start).format('DD/MM/YYYY HH:mm');
      var enddata= moment(info.event.end).format('DD/MM/YYYY HH:mm');
      var start = moment(info.event.start).format('DD/MM/YYYY HH:mm');
      var end = moment(info.event.end).format('DD/MM/YYYY HH:mm');
      
      $.ajax({
          url : 'http://localhost/sistemaClinica/ResizeDrop.php',
          method: "POST",
          data : {id: id,dentista_id: dentista_id, starttime: starttime,endtime: endtime,startdate: startdate,enddata: enddata, start: start, end: end},
      });
    },
    // Salva o arraste de evento para outro dia
    eventDrop : function(info) {
      var id = info.event.id;
      var dentista_id = info.event.dentista_id;
      var starttime= moment(info.event.start).format('HH:mm');
      var endtime= moment(info.event.end).format('HH:mm');
      var startdate= moment(info.event.start).format('DD/MM/YYYY HH:mm');
      var enddata= moment(info.event.end).format('DD/MM/YYYY HH:mm');
      var start = moment(info.event.start).format('DD/MM/YYYY HH:mm');
      var end = moment(info.event.end).format('DD/MM/YYYY HH:mm');
      
      $.ajax({
          url : 'http://localhost/sistemaClinica/ResizeDrop.php',
          method: "POST",
          data : {id: id,dentista_id: dentista_id, starttime: starttime,endtime: endtime,startdate: startdate,enddata: enddata, start: start, end: end},
      });
    },
    eventContent: function(info){
      var items = document.getElementById('dentista_id');
      items.addEventListener('change', function(){
        var opcaoValor = items.options[items.selectedIndex].value;
        // var opcaoTexto = items.options[items.selectedIndex].text;
        if(info.event.extendedProps.dentista_id == opcaoValor){
          info.event.setProp('display', 'block');
          console.log(info);
        }else{
          info.event.setProp('display', 'none');
        }
      })
    },
    locale: 'pt-br',
    customButtons: {
      // Add custom datepicker
      datepicker: {
          click: function(e) {
              picker.show();
          }
      }
    }, 
    events: 'lista_eventos.php',  
    extraParams: function () {
      return {
        cachebuster: new Date().valueOf()
      };
    }
  });
  calendar.render();

  // Initialize Pikaday
  var picker = new Pikaday({
    field: document.querySelector('.fc-datepicker-button'),
    format: 'yy-mm-dd',
    onSelect: function(dateString) {
        picker.gotoDate(new Date(dateString));
        calendar.gotoDate(new Date(dateString));
    },
    i18n: {
    previousMonth : 'Previous Month',
    nextMonth     : 'Next Month',
    months        : ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    weekdays      : ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    weekdaysShort : ['dom','seg','ter','qua','qui','sex','sáb']
    }
  });
});

$(document).ready(function(){
      $('#alterar').on("click", function(){
      $('#editar').slideToggle();
      $('#form').slideToggle();
    });      

    $('#cancelar').on("click", function(){
      $('#form').slideToggle();
      $('#editar').slideToggle();
    });  
});

