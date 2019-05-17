var main = $('#results');
var res;
var filtered;

    $.post("/index.php/match/json",
    {
    },
    function(data, status){
        //console.log(data);
        res = JSON.parse(data);

        filtered = res.filter(function (elem) {
            return parseInt(elem.distance) <= 500
          });
          display(filtered);

        $('.sorting').click(function(e)
        {
            e.preventDefault();
            sort = e.target.dataset.sort;
            //console.log(sort);

            sorted = filtered.sort(function(a, b){
                return a[`${sort}`] - b[`${sort}`];
            });

            display(sorted);
        });
 
        $('#filter').click(function(e)
        {
            e.preventDefault();
            var distance = $('#val_distance')[0].innerHTML;
            var pop_score = $('#val_pop_score')[0].innerHTML;
            var ageLow = $('#val_ageLow')[0].innerHTML;
            var ageHigh = $('#val_ageHigh')[0].innerHTML;
            //console.log(pop_score);
            //console.log(distance);
            //console.log(ageHigh);
            //console.log(ageLow);

            tagssearch = $('#searchtags').val().split(';');

            filtered = res.filter(function (elem) {
                if (elem.tags)
                    tagsarray = elem.tags.split(',');
                else
                    tagsarray = [];
                //console.log(tagssearch);
                //console.log(tagsarray);
                var tagsok = tagssearch.every(function (e)
                {
                    return tagsarray.includes('#' + e.trim());
                });
                if ($('#searchtags').val() === '' || elem.tags == '')
                    tagsok = true;
                return parseInt(elem.distance) <= distance &&
                tagsok && elem.pop_score >= pop_score &&
                ageLow <= elem.age && elem.age <= ageHigh;
              });
              display(filtered);
            
        });

    }).fail(function (e){ console.log(e); });

    function display(dataset)
    {
        main.empty();
        $.each(dataset, function(index, data) {
            console.log(data);
            if (data.profilepicture == null)
                return ;
            else if (data.profilepicture.substring(0,4) == 'http')
                pp = data.profilepicture;
            else
                pp = window.location.origin + '/' + data.profilepicture;
            main.append(`<div class="container">
            
                <div class="card">
                    <div class="row" style="width:100%">
                        <a class="col-md-4" href="/profile/show/${data.id}" style="text-decoration: none">
                            <img class="w-100" src="${pp}" alt="avatar" width="60">
                        </a>
                
                        <div class="col-md-8 ">
                            <p class="card-text card_text">
                            <strong><em>${data.name}
                                    ${data.lastname}</em></strong><br>
                                <em>${data.age}</em> ans<br>
                                <em>${data.genre}</em><br>
                                <em>${data.orientation}</em><br>
                                <em>${parseInt(data.distance)} </em>km
                            </p>
                        </div>
                    </div>
                </div>
            
        </div>
        <br>`);

        });
    }