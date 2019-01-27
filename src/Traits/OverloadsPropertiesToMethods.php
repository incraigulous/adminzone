<?php

/**
 * Trait helps to allow for some limited overloading of
 * methods in the class this is attached to.
 */
trait OverloadsPropertiesToMethods {


    /**
     * Where the magic happens
     * @param  string $name The name of the function that was called
     * @param  array $args An array containing arguments
     */
    public function __call($method, $parameters)
    {


        // We'll need some information about our class and methods
        // before we can route this call (if it is routable)
        $reflection = new \ReflectionClass(get_class($this));

        // Grab the possible matches
        $matches = $this->__filterMethodsForMatches($method, $reflection->getMethods());

        // If matches are found, let's evaulate them to see if they can be called.
        if( count($matches) > 0 ) :
            // We'll take a look at the parameters and then get the datatypes
            // for each one.
            $parameterTypes = $this->__resolveparameterTypes($parameters);

            /**
             * In order for there to be a match a few conditions must be met.
             * 1) The first part of the function name must match exactly
             * 2) The number of paramters passed must be in the same order
             * as the definition and match the type.
             */
            foreach($matches as $candidate ) :
                // Get information about the candidate
                $info =  $this->__candidateMatch($reflection->getMethod($candidate), $parameterTypes);
                if( $info['provided_parameters'] == $info['matched_parameter_types'] && $info['primary_parameter_matches']) :
                    return call_user_func_array([$this, $candidate], $parameters);
                endif;
            endforeach;
        endif;

        /**
         * First, if this method is being called by
         * the parent, let's make sure we get it out of the way
         * first.
         */
        if( is_callable(['parent', '__call']) ) :
            parent::__call($method, $parameters);
        endif;
    }

    /**
     * Filter through all the methods in the class and look for any that will be possible matches.
     * @param  string $methodName   The name of the method that was called
     * @param  array $classMethods The PHP Reflection list of methods
     * @return array               Possible Matches
     */
    private function __filterMethodsForMatches($methodName, $classMethods)
    {
        // We'll return this at the end if we find any matches
        $possibleMatches = [];

        // Cycle through each method found and see if it
        // matches the pattern we are looking for
        foreach($classMethods as $classMethod ) :
            if(strstr($classMethod->name, $methodName)) {
                array_push($possibleMatches, $classMethod->name);
            }
        endforeach;

        return $possibleMatches;
    }

    /**
     * Creates an array matching the order of the parameters provided
     * but instead of the datatype of the parameter.
     *
     * @param  array  $parameters [description]
     * @return array
     */
    private function __resolveparameterTypes($parameters = [])
    {
        if( empty($parameters) ) return [];

        $resolved = [];

        foreach( $parameters as $parameter ) :
            switch(gettype($parameter)) {
                case 'double':
                    $resolved[] = 'float'; // gettype() returns 'double' instead of float
                    break;
                case 'object':
                    $reflector = new \ReflectionClass($parameter);
                    $resolved[] = $reflector->getName();
                    break;
                default:
                    $resolved[] = gettype($parameter);
            }
        endforeach;

        return $resolved;
    }

    /**
     * Checks to see if a given candidate matches based on the information provided
     * @param  ReflectionMethod $candidate      The candidate method
     * @param  array  $paramaterTypes [description]
     * @return [array]                 [description]
     */
    private function __candidateMatch($candidate, $parameterTypes = [])
    {
        $info = [
            'defined_parameters' => count($candidate->getParameters()),
            'provided_parameters' => count($parameterTypes),
            'matched_parameter_types' => 0,
            'primary_parameter_matches' => false,
        ];


        // We'll spin through the candidates paramter requirements and see if they match the appropriate types
        foreach ($candidate->getParameters() as $index => $parameter) :
            // Some methods may have default values attached at the end
            if( !array_key_exists($index, $parameterTypes) ) break;
            if( !is_null($parameter->getType()) && $parameter->getType()->getName() == $parameterTypes[$index]) :
                $info['matched_parameter_types']++;
                if( $index == 0 ) :
                    $info['primary_parameter_matches'] = true;
                endif;
            endif;
        endforeach;

        return $info;
    }
}
