
<div>
    <h2>Search</h2>
    <form method="post" action="/results">
        {daysearch} {timeslotsearch}
        <button type="submit">search</button>
    </form>
</div>

    
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <h2>Days of Week</h2>
                {daysofweek}
                COURSE:
                {coursename}</br>
                {day}: {time}</br>
                {instructor}</br>
                {building}: {room}</br>
                {type}</br></br>
                {/daysofweek}
            </div>
            <div class="col-lg-4 col-md-4">
                <h2>Periods</h2>
                {periods}
                COURSE:
                {coursename}</br>
                {day}: {time}</br>
                {instructor}</br>
                {building}: {room}</br>
                {type}</br></br>
                {/periods}
            </div>
            <div class="col-lg-4 col-md-4">
                <h2>Courses</h2>
                {courses}
                COURSE:
                {coursename}</br>
                {day}: {time}</br>
                {instructor}</br>
                {building}: {room}</br>
                {type}</br></br>
                {/courses}
            </div>
        </div>
    </div>
