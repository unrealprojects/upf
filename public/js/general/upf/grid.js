upf.Grid = {};
/*********************************************************************************************************************** Horizontal Alignment ***/
upf.Grid.HorizontalAlignment = function(){
    // Default Variables
    var GridClass            =   '.Grid, .Control-Group',   // Used Grid Class Names
        NodeClass            =   'Node',                    // Node Class Name
        OpenRowClass         =   'Row-Open',                // Default Row-Open Class Name
        CloseRowClass        =   'Row-Close',               // Default Row-Close Class Name
        GridSize             =   12;                        // Default Grid Size

    // Each Grid
    $(GridClass).each(function(GridKey,Grid){
        var NodeCounter = 0;
        // Each Node
        $(Grid).find('>[class*='+NodeClass+']').each(function(NodeKey,Node){
            var NodeSize = 0;
            // First Node
            if(NodeKey==0){
                $(Node).addClass(OpenRowClass);
            }
            // Last Node
            if(!$(Node).next().length){
                $(Node).addClass(CloseRowClass);
            }

            // Each Class :: Get Node Size + Change Node Counter
            $.each($(Node).attr('class').split(' '),function(ClassKey,Class){
                var SplitClass = Class.split('-');
                if(SplitClass.length == 3 && SplitClass[0] == NodeClass){
                    NodeSize =  parseInt(SplitClass[2]);
                    NodeCounter = NodeCounter + NodeSize;
                    return false;
                }
            });

            // Completed Row
            if(NodeCounter >= GridSize){
                $(Node).addClass(CloseRowClass);
                if($(Node).next().length){
                    $(Node).next().addClass(OpenRowClass);
                }
                NodeCounter = 0;
            }
            // Overflowed Row
            else if(NodeCounter > GridSize){
                $(Node).addClass(OpenRowClass);
                if($(Node).prev().length){
                    $(Node).prev().addClass(CloseRowClass);
                }
                NodeCounter = NodeSize;
            }

        });
    });
}
/*
    todo: С учетом ViewPort
    todo: С учетом разных GridSize
    todo: С учетом Content Change
    ask: Если просто Grid то он 12-колоночный, Grid-7 Строгое колличество колонок
 */
/*********************************************************************************************************************** Execute Functions ***/
upf.Grid.HorizontalAlignment();







