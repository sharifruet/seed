'use strict';

//const API_URL_BASE = 'https://kakon.bandhanhara.com/rest/'
const API_URL_BASE = 'http://localhost/pos/rest/'

class BodyContent extends React.Component {
	constructor(props) {
	    super(props);
	    this.state = {
	        error: null,
	        isLoaded: false,
	        transaction: {},
	        soldItems: [],
	        items: [],
	        warehouseId : -1
	      };
	    
	    this.handleWarehouseChange = this.handleWarehouseChange.bind(this)
	  }
	
	handleWarehouseChange(arg){
		this.setState({warehouseId: arg});
		
		fetch(API_URL_BASE +'item', {
			  method: 'POST',
			  headers: {
			    'Accept': 'application/json',
			    'Content-Type': 'application/json',
			  },
			  body: JSON.stringify(
				  {
						operation : "getByFilter",
						filter:{warehouseId:this.state.warehouseId},
			    }
			  )
			})
			.then(
		        (result) => {
		          this.setState({
		            items: result.data
		          });
		        },
		        // Note: it's important to handle errors here
		        // instead of a catch() block so that we don't swallow
		        // exceptions from actual bugs in components.
		        (error) => {
		        }
		      );
		
	}
	render() {
		return (
			  <div className="row">
			  	<div className="col-md-12">
				  <div className="row">
			      	<div className="col-md-3"> <Warehouse handleChangeUpdate={this.handleWarehouseChange}/> </div>
			      	<div className="col-md-3"> <Barcode/> </div>
			      	<div className="col-md-3"> <SearchProduct/> </div>
			      	<div className="col-md-3"> {this.state.warehouseId} </div>
			      </div>
			      <div className="row">
			      	<div className="col-md-8">
			      		<SaleDetails/>
			      	</div>
			      	<div className="col-md-4">
			      		<PaymentDetails/>
			      	</div>
			      </div>
			    </div>
		      </div>
		   );
	}
}

class Warehouse extends React.Component {
	  constructor(props) {
	    super(props);
	    this.state = {
	    	value: '',
	        error: null,
	        isLoaded: false,
	        warehouses: []
        }
	    this.handleChange = this.handleChange.bind(this);
	  }

	  handleChange(event) {
	    this.setState({value: event.target.value});
	    this.props.handleChangeUpdate(event.target.value);
	  }
	  
	  componentDidMount() {
		    fetch(API_URL_BASE + "warehouse/getItems")
		      .then(res => res.json())
		      .then(
		        (result) => {
		          this.setState({
		            isLoaded: true,
		            warehouses: result.data
		          });
		        },
		        // Note: it's important to handle errors here
		        // instead of a catch() block so that we don't swallow
		        // exceptions from actual bugs in components.
		        (error) => {
		          this.setState({
		            isLoaded: true,
		            error
		          });
		        }
		      )
		  }
	  
	  render () {
	        let warehouseList = this.state.warehouses;
	        let warehouseOptions = warehouseList.map((warehouse) =>
	                <option key={warehouse.componentId} value={warehouse.componentId}>{warehouse.name}</option>
	            );

	        return (
	         <div>
	         	 <label> Warehouse : </label>
	             <select className="form-control" onChange={ (e) => {this.handleChange(e);}}>
	             	<option value=""> Select warehouse</option>
	                {warehouseOptions}
	             </select>
	         </div>
	        )
	    }
}
class Barcode extends React.Component {
	  constructor(props) {
	    super(props);
	    this.state = {
	    	value: '',
	        error: null
	      };

	    this.handleChange = this.handleChange.bind(this);
	    this.handleSubmit = this.handleSubmit.bind(this);
	  }

	  handleChange(event) {
	    this.setState({value: event.target.value});
	  }

	  handleSubmit(event) {
	    alert('Your favorite flavor is: ' + this.state.value);
	    event.preventDefault();
	  }

	  render () {
	        return (
	         <div>
	         	 <label> Barcode : </label>
	             <input className="form-control"/>
	         </div>
	        )
	    }
}

class SearchProduct extends React.Component {
	  constructor(props) {
	    super(props);
	    this.state = {
	    	value: '',
	    	dataSource : '',
	        error: null
	      };

	    this.handleChange = this.handleChange.bind(this);
	  }

	  handleChange(event) {
	    this.setState({value: event.target.value});
	  }
	  render () {
	        return (
	         <div>
	         	 <label> Search Product : </label>
	         	<Example/>
	         </div>
	        )
	    }
}

class SaleDetails extends React.Component {
	  constructor(props) {
	    super(props);
	    this.state = {
	    	value: '',
	    	items: [
	        	{componentId : "100001", itemName : "Sunsilk Shampoo", quantity : 2, unitPrice : 125.50},
	        	{componentId : "100002", itemName : "Sunsilk Shampoo", quantity : 3, unitPrice : 135.50},
	        	{componentId : "100003", itemName : "Sunsilk Shampoo", quantity : 4, unitPrice : 145.50},
	        	],
	        error: null
	      };

	    this.handleChange = this.handleChange.bind(this);
	  }

	  handleChange(event) {
	    this.setState({value: event.target.value});
	  }
	  render () {
	        return (
	         <div>
	         	 <table className = "table">
	         	 	<thead>
	         	 		<tr>
		         	 		<th> S/L </th>
		         	 		<th> Product </th>
		         	 		<th> Rate </th>
		         	 		<th> Quantity </th>
		         	 		<th> Subtotal </th>
		         	 		<th> &nbsp; </th>
		         	 	</tr>
	         	 	</thead>
	         	 	<tbody>
	         	 	    {this.state.items.map((item, i) => <SaleRow key = {i} 
                            data = {item} />)}
	         	 	</tbody>
	         	 </table>
	         </div>
	        )
	    }
}

class SaleRow extends React.Component {
   render() {
      return (
         <tr>
            <td>{this.props.data.componentId}</td>
            <td>{this.props.data.itemName}</td>
            <td>{this.props.data.unitPrice}</td>
            <td>{this.props.data.quantity}</td>
            <td>{(this.props.data.quantity*this.props.data.unitPrice).toFixed(2)}</td>
            <td>&nbsp;</td>
         </tr>
      );
   }
}

class PaymentDetails extends React.Component {
	  constructor(props) {
	    super(props);
	    this.state = {
	    	value: '',
	        error: null
	      };

	    this.handleChange = this.handleChange.bind(this);
	  }

	  handleChange(event) {
	    this.setState({value: event.target.value});
	  }
	  render () {
	        return (
	         <div>
	         	 <table className = "table">
	         	 	<thead>
	         	 		<tr>
		         	 		<th> S/L </th>
		         	 		<th> Product </th>
		         	 		<th> Rate </th>
		         	 		<th> Quantity </th>
		         	 		<th> Subtotal </th>
		         	 		<th> &nbsp; </th>
		         	 	</tr>
	         	 	</thead>
	         	 	<tbody>
	         	 	</tbody>
	         	 </table>
	         </div>
	        )
	    }
}



//Imagine you have a list of languages that you'd like to autosuggest.
const languages = [
	  {	    name: 'C',	    	year: 1972	  },
	  {	    name: 'C#',	    	year: 2000	  },
	  {	    name: 'C++',		year: 1983	  },
	  {	    name: 'Clojure',	year: 2007	  },
	  {	    name: 'Elm',	    year: 2012	  },
	  {	    name: 'Go',	    	year: 2009	  },
	  {	    name: 'Haskell',	year: 1990	  },
	  {	    name: 'Java',	    year: 1995	  },
	  {	    name: 'Javascript',	year: 1995	  },
	  {	    name: 'Perl',	    year: 1987	  },
	  {	    name: 'PHP',	    year: 1995	  },
	  {	    name: 'Python',	    year: 1991	  },
	  {	    name: 'Ruby',	    year: 1995	  },
	  {	    name: 'Scala',	    year: 2003	  }
	];
	// https://developer.mozilla.org/en/docs/Web/JavaScript/Guide/Regular_Expressions#Using_Special_Characters
	function escapeRegexCharacters(str) {
	  return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
	}

	function getSuggestions(value) {
	
	  const escapedValue = escapeRegexCharacters(value.trim());
	  
	  if (escapedValue === '') {
	    return [];
	  }

	  const regex = new RegExp('^' + escapedValue, 'i');
		
	  return languages.filter(language => regex.test(language.name));
	}

	function getSuggestionValue(suggestion) {
	  return suggestion.name;
	}

	function renderSuggestion(suggestion) {
	  return (
	    <span>{suggestion.name}</span>
	  );
	}
class Example extends React.Component {
	  constructor() {
		    super();

		    this.state = {
		      value: '',
		      suggestions: getSuggestions('')
		    };
		    
		    this.onChange = this.onChange.bind(this);
		    this.onSuggestionsUpdateRequested = this.onSuggestionsUpdateRequested.bind(this);
		    this.saveInput = this.saveInput.bind(this);
		  }
		  
		  componentDidMount() {
		    this.input.focus();
		  }
		  
		  onChange(event, { newValue, method }) {
		    this.setState({
		      value: newValue
		    });
		  }
		    
		  onSuggestionsUpdateRequested({ value }) {
		    this.setState({
		      suggestions: getSuggestions(value)
		    });
		  };
		  
		
		  
		  saveInput(autosuggest) {
		    this.input = autosuggest.input;
		  };

		  onSuggestionsFetchRequested = ({ value }) => {
			    this.setState({
			      suggestions: getSuggestions(value)
			    });
			  };

			  // Autosuggest will call this function every time you need to clear suggestions.
			  onSuggestionsClearRequested = () => {
			    this.setState({
			      suggestions: []
			    });
			  };
		  render() {
		    const { value, suggestions } = this.state;
		    const inputProps = {
		      placeholder: "Type 'c'",
		      value,
		      onChange: this.onChange
		    };
		    
		   

		    return (
		      <Autosuggest suggestions={suggestions}
		      onSuggestionsFetchRequested={this.onSuggestionsFetchRequested}
		        onSuggestionsClearRequested={this.onSuggestionsClearRequested}
		                   onSuggestionsUpdateRequested={this.onSuggestionsUpdateRequested}
		                   getSuggestionValue={getSuggestionValue}
		                   renderSuggestion={renderSuggestion}
		                   inputProps={inputProps}
		                   ref={this.saveInput} />
		       
		    );
		  }
		}


ReactDOM.render(<BodyContent name="Mark" />, document.getElementById('root'));