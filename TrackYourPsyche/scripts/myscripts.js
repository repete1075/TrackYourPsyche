function Datecheck(){
    const date= new Date();
    var year=date.getFullYear();
    var month=date.getMonth()+1;
    var day=date.getDate();
    var finaldate=year+"/"+month+"/"+day;

    var thedate=document.getElementById('datebox');
    thedate.value=finaldate;
}
