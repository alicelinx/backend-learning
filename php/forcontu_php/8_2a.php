<?php

// a) Perform a query that returns the 5 European countries with the largest population, ordered from largest to smallest population. 
echo "SELECT Name, Population FROM country WHERE Continent = 'Europe' ORDER BY Population DESC LIMIT 5;<br>";

// b) Performs a query that returns all the regions available in the country table, without repeating and in alphabetical order.
echo "SELECT DISTINCT Region from country ORDER BY Region ASC;<br>";

// c) Perform a query that inserts a new fictitious country called Polyphemus (code PFM). You can make up the rest of the values. 
echo "INSERT INTO country (Code, Name, Continent, Region, SurfaceArea, IndepYear, Population, LifeExpectancy, GNP, GNPOld, LocalName, GovernmentForm, HeadOfState, Capital, Code2) VALUES ('PFM', 'Polyphemus', 'North America', 'Caribbean', 299, NULL, 1100000, 75, 900, 870, 'Polyphemus', 'Nonmetropolitan Territory of The Netherlands', 'Beatrix', 138, 'PM');<br>";

// d) Make a query that inserts a new city called Pandora, belonging to Polyphemus.
echo "INSERT INTO city (Name, CountryCode, District, Population) VALUES ('Pandora', 'PFM', 'Pandaria', 200000);<br>";

// e) Perform a query that updates the population of Spain to 46,524,943.
echo "UPDATE country SET Population = 46524943 WHERE Name = 'Spain';<br>";

// f) Performs a query that eliminates Spanish cities with less than 100,000 inhabitants.
echo "DELETE FROM city WHERE Population < 100000 AND CountryCode = 'ESP';<br>";
?>