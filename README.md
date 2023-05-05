# Rado Starter Theme

The first version of Rado's starter Wordpress theme based on [underscores] theme.

## Compiling

* Change to the project's root directory.

* Install project dependencies with 
    ```
    npm i
    ```

* Run Grunt with 
    ```
    grunt
    ```
  
* Run predefined tasks whenever watched file patterns are added, changed or deleted
    ```
    grunt watch
    ```
    
* Installing/Updating node_modules
    ```
    npm update
    ```

## Main coding style
* 2 spaces for HTML/PHP, CSS, JavaScript etc.
* BEM (Block__Element--Modifier) naming convention ( More at https://en.bem.info/methodology/css/ )
    ```css
    .block {
      &__element {
        &--modifier {
          ...
        }
      }
    }
    ```
* ESLint enforces several stylistic rules to help with error checking and keeping a consistent style. For example:
    >no-multiple-empty-lines: One empty line is allowed.
    
    >no-unused-vars: Exportable assets must be prefixed with export (e.g. exportImages).
    
    >camelcase: Only camelCase is allowed.
    
    >no-plusplus: Increment/Decrement operators are allowed anywhere.
    
    >comma-dangle: Dangling commas are allowed in object/array lists.   
* Other ESLint rules can be found here: https://github.com/eslint/eslint/tree/master/docs/rules

## Other
* When using `target="_blank"` to open a link in a new tab, remember to always follow it up with `rel="noopener noreferrer"` for security (anti-phishing) reasons.
* For any hardcoded text, it is highly recommended to use PHP/Wordpress translation functions, such as `__()` or `_e()`. Original text must be english to ensure easy WPML translation.