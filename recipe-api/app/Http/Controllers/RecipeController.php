<?php

namespace App\Http\Controllers;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('https://api.spoonacular.com/recipes/random?apiKey=799628c184dd4918b97bb1c76736e21f');

        // hier code schrijven die het formaat aanpast en goed terug geeft wat je wilt

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ingredients' => 'required',
            'description' => 'required'
        ]);
        return Recipe::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get('https://api.spoonacular.com/recipes/' . $id . '/information?apiKey=799628c184dd4918b97bb1c76736e21f');
        $recipe = $response->json();


        $ingredients = array();
        foreach($recipe['extendedIngredients'] as $ingredient){
            $ingredients[] = [
                'name' => $ingredient['name'],
                'amount' => $ingredient['amount'],
                'unit' => $ingredient['unit']
            ];
        }

        $data = [
            'title' => $recipe['title'],
            'image' => 'https://spoonacular.com/recipeImages/' . $id . '-556x370.jpg',
            'vegetarian' => $recipe['vegetarian'],
            'summary' => strip_tags($recipe['summary']),
            'ingredients' => $ingredients,
            'instructions' => $recipe['instructions']
        ];

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $recipe = Recipe::find($id);
        $recipe->update($request->all());
        return $recipe;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return int
     */
    public function destroy($id)
    {
        return Recipe::destroy($id);
    }

    /**
     * Search for name of recipe
     *
     * @param  string $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Recipe::where('name', 'like', '%'.$name.'%')->get();
    }
}
