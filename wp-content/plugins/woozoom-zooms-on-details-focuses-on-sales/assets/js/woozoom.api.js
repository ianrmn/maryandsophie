var woozoom = {};

/** hooks api **/
woozoom.hooks_api = function() {
	var slice = Array.prototype.slice;
	
	/**
	 * Maintain a reference to the object scope so our public methods never get confusing.
	 */
	var MethodsAvailable = {
		removeFilter : removeFilter,
		applyFilters : applyFilters,
		addFilter : addFilter,
		removeAction : removeAction,
		doAction : doAction,
		addAction : addAction
	};

	/**
	 * Contains the hooks that get registered with hooks_api.
	 */
	var STORAGE = {
		actions : {},
		filters : {}
	};

	/**
	 * Adds an action to the hooks_api
	 */
	function addAction( action, callback, priority, context ) {
		if( typeof action === 'string' && typeof callback === 'function' ) {
			priority = parseInt( ( priority || 10 ), 10 );
			_addHook( 'actions', action, callback, priority, context );
		}

		return MethodsAvailable;
	}

	/**
	 * Performs an action if it exists. You can pass as many arguments as you want to this function; the only rule is
	 * that the first argument must always be the action.
	 */
	function doAction( /* action, arg1, arg2, ... */ ) {
		var args = slice.call( arguments );
		var action = args.shift();

		if( typeof action === 'string' ) {
			_runHook( 'actions', action, args );
		}

		return MethodsAvailable;
	}

	/**
	 * Removes the specified action if it contains an action & exists.
	 */
	function removeAction( action, callback ) {
		if( typeof action === 'string' ) {
			_removeHook( 'actions', action, callback );
		}
		return MethodsAvailable;
	}

	/**
	 * Adds a filter to the hooks_api.
	 */
	function addFilter( filter, callback, priority, context ) {
		if( typeof filter === 'string' && typeof callback === 'function' ) {
			priority = parseInt( ( priority || 10 ), 10 );
			_addHook( 'filters', filter, callback, priority, context );
		}
		return MethodsAvailable;
	}

	/**
	 * Performs a filter if it exists. You should only ever pass 1 argument to be filtered. The only rule is that
	 * the first argument must always be the filter.
	 */
	function applyFilters( /* filter, filtered arg, arg2, ... */ ) {
		var args = slice.call( arguments );
		var filter = args.shift();

		if( typeof filter === 'string' ) {
			return _runHook( 'filters', filter, args );
		}
		return MethodsAvailable;
	}

	/**
	 * Removes the specified filter if it contains an filter & exists.
	 */
	function removeFilter( filter, callback ) {
		if( typeof filter === 'string') {
			_removeHook( 'filters', filter, callback );
		}
		return MethodsAvailable;
	}

	/**
	 * Removes the specified hook by resetting the value of it.
	 */
	function _removeHook( type, hook, callback, context ) {
		var handlers, handler, i;
		
		if ( !STORAGE[ type ][ hook ] ) {
			return;
		}
		if ( !callback ) {
			STORAGE[ type ][ hook ] = [];
		} else {
			handlers = STORAGE[ type ][ hook ];
			if ( !context ) {
				for ( i = handlers.length; i--; ) {
					if ( handlers[i].callback === callback ) {
						handlers.splice( i, 1 );
					}
				}
			}
			else {
				for ( i = handlers.length; i--; ) {
					handler = handlers[i];
					if ( handler.callback === callback && handler.context === context) {
						handlers.splice( i, 1 );
					}
				}
			}
		}
	}

	/**
	 * Adds the hook to the appropriate storage container
	 */
	function _addHook( type, hook, callback, priority, context ) {
		var hookObject = {
			callback : callback,
			priority : priority,
			context : context
		};

		var hooks = STORAGE[ type ][ hook ];
		if( hooks ) {
			hooks.push( hookObject );
			hooks = _hookInsertSort( hooks );
		}
		else {
			hooks = [ hookObject ];
		}
		STORAGE[ type ][ hook ] = hooks;
	}

	/**
	 * Use an insert sort for keeping our hooks organized based on priority.
	 */
	function _hookInsertSort( hooks ) {
		var tmpHook, j, prevHook;
		for( var i = 1, len = hooks.length; i < len; i++ ) {
			tmpHook = hooks[ i ];
			j = i;
			while( ( prevHook = hooks[ j - 1 ] ) &&  prevHook.priority > tmpHook.priority ) {
				hooks[ j ] = hooks[ j - 1 ];
				--j;
			}
			hooks[ j ] = tmpHook;
		}
		return hooks;
	}

	/**
	 * Runs the specified hook. If it is an action, the value is not modified but if it is a filter, it is.
	 */
	function _runHook( type, hook, args ) {
		var handlers = STORAGE[ type ][ hook ], i, len;
		
		if ( !handlers ) {
			return (type === 'filters') ? args[0] : false;
		}

		len = handlers.length;
		if ( type === 'filters' ) {
			for ( i = 0; i < len; i++ ) {
				args[ 0 ] = handlers[ i ].callback.apply( handlers[ i ].context, args );
			}
		} else {
			for ( i = 0; i < len; i++ ) {
				handlers[ i ].callback.apply( handlers[ i ].context, args );
			}
		}

		return ( type === 'filters' ) ? args[ 0 ] : true;
	}

	// return all of the publicly available methods
	return MethodsAvailable;

};
woozoom.hooks = new woozoom.hooks_api();
