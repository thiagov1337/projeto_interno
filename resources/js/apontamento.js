alert(route());

function selecionar(NumOrp, CodCre, CodOri, SeqRot, CodRot){
    $.ajax({
        type: "POST",
        url: "",
        data: {
            NumOrp: NumOrp,
            CodCre: CodCre,
            CodOri: CodOri,
            SeqRot: SeqRot,
            CodRot: CodRot
        },
        success: function(result){
            console.log(result);
        }
    });
}