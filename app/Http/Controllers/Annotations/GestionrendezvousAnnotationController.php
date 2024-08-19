<?php

namespace App\Http\Controllers\Annotations ;

/**
 * @OA\Security(
 *     security={
 *         "BearerAuth": {}
 *     }),

 * @OA\SecurityScheme(
 *     securityScheme="BearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"),

 * @OA\Info(
 *     title="Your API Title",
 *     description="Your API Description",
 *     version="1.0.0"),

 * @OA\Consumes({
 *     "multipart/form-data"
 * }),

 *

 * @OA\PUT(
 *     path="/api/rdv/2",
 *     summary="modifier un rdv par un mentor",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="200", description="OK"),
 * @OA\Response(response="404", description="Not Found"),
 * @OA\Response(response="500", description="Internal Server Error"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/x-www-form-urlencoded",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="sujet", type="string"),
 *                     @OA\Property(property="date_rendezVous", type="string"),
 *                     @OA\Property(property="lieu", type="string"),
 *                     @OA\Property(property="type", type="string"),
 *                     @OA\Property(property="durée", type="integer"),
 *                     @OA\Property(property="lien", type="string", format="binary"),
 *                     @OA\Property(property="statut", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Gestion rendez-vous"},
*),


 * @OA\POST(
 *     path="/api/rdv",
 *     summary="Planifier rdv",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="201", description="Created successfully"),
 * @OA\Response(response="400", description="Bad Request"),
 * @OA\Response(response="401", description="Unauthorized"),
 * @OA\Response(response="403", description="Forbidden"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="sujet", type="string"),
 *                     @OA\Property(property="date_rendezVous", type="string"),
 *                     @OA\Property(property="lieu", type="string"),
 *                     @OA\Property(property="type", type="string"),
 *                     @OA\Property(property="durée", type="integer"),
 *                     @OA\Property(property="lien", type="string", format="binary"),
 *                     @OA\Property(property="statut", type="string"),
 *                     @OA\Property(property="mente_id", type="integer"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Gestion rendez-vous"},
*),


 * @OA\GET(
 *     path="/api/rdv",
 *     summary="liste des rdv pour mente",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="200", description="OK"),
 * @OA\Response(response="404", description="Not Found"),
 * @OA\Response(response="500", description="Internal Server Error"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     tags={"Gestion rendez-vous"},
*),


*/

 class GestionrendezvousAnnotationController {}
