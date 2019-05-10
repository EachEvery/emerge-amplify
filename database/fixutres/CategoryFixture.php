<?php

namespace App\Fixtures;

class CategoryFixture
{
    public function get()
    {
        return json_decode('[{"id":2,"display_name":"Autobiography","accent_color":"#EBAB21"},{"id":12,"display_name":"Essay","accent_color":"#F3797B"},{"id":22,"display_name":"Prose","accent_color":"#4151A3"},{"id":32,"display_name":"Poetry","accent_color":"#AEAD35"},{"id":42,"display_name":"Article","accent_color":"#8BD2CE"},{"id":52,"display_name":"Speech","accent_color":"#60D9A7"},{"id":72,"display_name":"Book","accent_color":"#AA6886"},{"id":82,"display_name":"Interview","accent_color":"#BE4B31"},{"id":92,"display_name":"Performance","accent_color":"#227f52"}]', true);
    }
}
