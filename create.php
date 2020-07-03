<?php include 'header.php';?>

<?php

class Node {
    public $qid = null;
    public $question = null;
    public $options = null;
    public $left = null;
    public $right = null;
    function __construct($qid, $question, $options, $left = null, $right = null) {
        $this->qid = $qid;
        $this->question = $question;
        $this->options = $options;
        $this->left = $left;
        $this->right = $right;
    }
}

?>
    
    <div class="container">
        <div class="justify-content-center">
            <div id="survey">
                <div id="savedQuesContainer">
                <br><br>
                    <div class="d-flex">
                        <div class="p-2 bg-info"><h5>Question</h5></div>
                        <div class="p-2 bg-info"><h5><div id="savedQid">1</div></h5></div>
                        <div class="p-2 bg-warning flex-grow-1"><div id="savedQuestion"></div></div>
                    </div>

                    <br>
                    <div class="d-flex">
                        <div class="p-2 bg-info"><h5>Option Type</h5></div>
                        <div class="p-2 bg-warning flex-grow-1"><div id="savedQuesType"></div></div>
                    </div>

                    <br>
                    <div class="d-flex justify-content-start">
                        <div class="p-2 bg-info"><h5>Options</h5></div>
                    </div>
                    <div class="d-flex flex-column" id="saved-options-container"></div>
                </div>
                
                <div id="editQuesContainer">
                <br><br>
                    <div class="d-flex">
                        <div class="p-2 bg-info"><h5>Question</h5></div>
                        <div class="p-2 bg-info"><h5><div id="qid">1</div></h5></div>
                        <div class="p-2 bg-warning flex-grow-1"><input type="text" id="question" name="question" class="form-control" required="required"></div>
                    </div>

                    <br>
                    <div class="d-flex">
                        <div class="p-2 bg-info"><h5>Option Type</h5></div>
                        <div class="p-2 bg-warning flex-grow-1">
                            <h5>
                            <input type="radio" name="quesType" value="single" checked>
                            <label class="element-animation">Single type</label>
                            <input type="radio" name="quesType" value="multiple">
                            <label class="element-animation">Multiple type</label>
                            </h5>
                        </div>
                    </div>

                    <br>
                    <div class="d-flex justify-content-start">
                        <div class="p-2 bg-info"><h5>Options</h5></div>
                        <button type="button" class="btn btn-danger p-2" id="addOptions">+</button>
                    </div>
                    <div class="d-flex flex-column" id="options-container">
                        <div class="d-flex flex-row-reverse" id="option-container_0">
                            <button type="button" id="deleteOption_0" class="btn btn-danger p-2">x</button>
                            <input type="text" name="options[]" id="options_0" class="form-control options" required="required" placeholder="option">
                        </div>
                    </div>
                </div>

                
                <br><br><br>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary" id="prevButton">Previous</button> 
                    <button type="button" class="btn btn-primary" id="editButton">Edit</button>
                    <button type="button" class="btn btn-primary" id="saveButton">Save Question</button>
                    <button type="button" class="btn btn-primary" id="nextButton">Next</button> 
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-success" id="submitForm">Submit Form</button>
                </div>
            </div>
        </div>
        
    </div>


    <script>
        $(document).ready(function(){
            var qid = 1;

            class Node{
                constructor(qid, question, quesType, options, left = undefined, right = undefined){
                    this.qid = qid;
                    this.question = question;
                    this.quesType = quesType;
                    this.options = options;
                    this.left = left;
                    this.right = right;
                }
            }
            var curr;

            function dispSaved(curr){
                $('#savedQuesContainer').show();
                $('#editButton').show();
                $('#editQuesContainer').hide();
                $('#saveButton').hide();
                if(curr!==undefined){
                    console.log("saved:"+Object.values(curr));
                    $('#savedQid').val(curr.qid);
                    // console.log(curr.question);
                    $('#savedQuestion').text(curr.question);
                    $('#savedQuesType').text(curr.quesType);

                    $('#saved-options-container').empty();
                    $('#saved-options-container').append('<ul>');
                    var optsArray = curr.options;
                    for (i = 0; i < optsArray.length; ++i){
                        $('#saved-options-container').append('<div class="p-2 bg-warning flex-grow-1"><li>'+optsArray[i]+'</li></div>');
                    }
                    $('#saved-options-container').append('</ul>');
                }
            }

            function dispEdit(curr){
                $('#editQuesContainer').show();
                $('#saveButton').show();
                $('#savedQuesContainer').hide();
                $('#editButton').hide();
                console.log("type:"+typeof curr);
                if(curr===undefined){
                    console.log("if");
                    $('#qid').text(qid);
                    $('#question').val("");
                    // console.log("check1:"+$('#question').val());
                    $('input:radio[name="quesType"]').filter('[value="single"]').attr('checked', true);
                    $('#options-container').empty();
                    $("#options-container").append('<div class="d-flex flex-row-reverse" id="option-container_0">'
                        +'<button type="button" id="deleteOption_0" class="btn btn-danger p-2">x</button>'
                        +'<input type="text" name="options[]" id="options_0" class="form-control" required="required" placeholder="option"></div>'); 
                }else{
                    console.log("edit:"+Object.values(curr));
                    console.log("else");
                    $('#qid').text(curr.qid);
                    $('#question').text(curr.question);
                    if(curr.quesType=='multiple'){
                        $('input:radio[name="quesType"]').filter('[value="multiple"]').attr('checked', true);
                    }else{
                        $('input:radio[name="quesType"]').filter('[value="single"]').attr('checked', true);
                    }
                    var optsArray = curr.options;
                    $('#options-container').empty();
                    optionNo = 0;
                    for (i = 0; i < optsArray.length; ++i){
                        $("#options-container").append('<div class="d-flex flex-row-reverse" id="option-container_' + optionNo + '">'
                            +'<button type="button" id="deleteOption_' + optionNo + '" class="btn btn-danger p-2">x</button>'
                            +'<input type="text" name="options[]" id="options_' + optionNo + '" class="form-control" required="required" placeholder="option" value="'+ optsArray[i] +'"></div>'); 
                        optionNo = optionNo + 1;
                    }
                }
            }

            if(curr===undefined){
                dispEdit(curr);
            }

            var optionNo = 1;
            //====================<Add Option>========================================
            $("#addOptions").click(function(){
                $("#options-container").append('<div class="d-flex flex-row-reverse" id="option-container_' + optionNo + '">'
                    +'<button type="button" id="deleteOption_' + optionNo + '" class="btn btn-danger p-2">x</button>'
                    +'<input type="text" name="options[]" id="options_' + optionNo + '" class="form-control" required="required" placeholder="option"></div>'); 
            optionNo = optionNo + 1;
            });
            //====================</Add Option>========================================

            //====================<Delete Option>========================================
            $(document).on("click", "[id^='deleteOption']" , function() {
                var option_id = $(this).attr('id');
                var option_str = option_id.split("_");
                var num = option_str[1];
                console.log("deleted:"+num);
                $('#option-container_'+num).remove();
            });
            //====================</Delete Option>========================================

            //====================<Save Question>========================================
            $(document).on("click", "#saveButton" , function() {
                // $('#options-container').find("[id^='deleteOption']").hide();
                // $('#options-container').find("[id^='options_']").prop('disabled', true);
                var ques = $('#question').val();
                var quesType = $('input[name="quesType"]:checked').val();
                
                var opts = new Array();
                $('#options-container').find("[id^='options_']").each(function(){
                    optval = $(this).val();
                    if(optval!==""){
                        opts.push($(this).val());
                    }
                });
                // console.log("ques:"+ques);
                // console.log("options:"+opts);  
                
                if(curr===undefined){
                    curr = new Node(qid, ques, quesType, opts);
                }else if(curr.qid==qid){
                    newnode = new Node(qid, ques, quesType, opts);
                    if(curr.right!==undefined){
                        curr.right.left = newnode;
                        newnode.right = curr.right;
                    }
                    if(curr.left!==undefined){
                        curr.left.right = newnode;
                        newnode.left = curr.left;
                    }
                    curr = newnode;
                }
                else{
                    newnode = new Node(qid, ques, quesType, opts);
                    curr.right = newnode;
                    newnode.left = curr;
                    curr = newnode;
                }
                // console.log('savedCurr:'+Object.values(curr));
                dispSaved(curr);
            });
            //====================</Save Question>========================================

            //====================<Edit Question>========================================
            $(document).on("click", "#editButton" , function() {
                // $('#options-container').find("[id^='deleteOption']").show();
                // $('#options-container').find("[id^='options_']").prop('disabled', false);
                dispEdit(curr);
                // console.log("editCurr:"+Object.values(curr));
                
            });
            //====================</Edit Question>========================================

            //====================<Next Question>========================================
            $(document).on("click", "#nextButton" , function() {
                qid+=1;
                if(curr.right!==undefined){
                    curr = curr.right;
                    dispSaved(curr);
                }else{
                    dispEdit(curr.right);
                    // $('#options-container').find("[id^='options_']").each(function(){
                    //     var option_id = $(this).attr('id');
                    //     var option_str = option_id.split("_");
                    //     var num = option_str[1];
                    //     if(num!=0){
                    //         $('#option-container_'+num).remove();
                    //     }
                    // });
                }
            });
            //====================</Next Question>========================================

            //====================<previous Question>========================================
            $(document).on("click", "#prevButton" , function() {
                qid-=1;
                if(curr.left!==undefined){
                    curr = curr.left;
                    console.log("prev defined");
                    console.log("a:"+Object.values(curr));
                    dispSaved(curr);
                }else{
                    dispEdit(curr.left);
                }
            });
            //====================</previous Question>========================================
        });
    </script>



    </body>
</html>