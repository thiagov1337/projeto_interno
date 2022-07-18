function selecionar(numorp, codori){
    $.ajax({
        type: 'GET',
        url: "http://127.0.0.1:8000/ordem",
        data: {
            numorp: numorp,
            codori: codori,
            // CodOri: CodOri,
            // SeqRot: SeqRot,
            // CodRot: CodRot
        },
        success: function(result){
            $("#NumOrp").val(result.numorp);
            $("#CodOri").val(result.codori);        
        }
    });
}

function apontar(){
    // $.ajax({
    //     type: 'GET',
    //     url: "http://127.0.0.1:8000/ordem",
    //     data: {
    //         numorp: numorp,
    //         codori: codori,
    //         // CodOri: CodOri,
    //         // SeqRot: SeqRot,
    //         // CodRot: CodRot
    //     },
    //     success: function(result){
    //         $("#NumOrp").val(result.numorp);
    //         $("#CodOri").val(result.codori);        
    //     }
    // });
}