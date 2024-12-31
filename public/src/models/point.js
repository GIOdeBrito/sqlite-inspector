
class Point
{
	#x = 0;
	#y = 0;

	constructor (x, y)
	{
		let values = this.#parseValues(x, y);

		this.#x = values[0];
		this.#y = values[1];
	}

	get X ()
	{
		return this.#x;
	}

	set X (value)
	{
		this.#x = value;
	}

	get Y ()
	{
		return this.#y;
	}

	set Y (value)
	{
		this.#y = value;
	}

	static get zero ()
	{
		return new Point(0, 0);
	}

	#parseValues (...values)
	{
		return values.map(value =>
		{
			if(typeof value === "number")
			{
				value = `${value}px`;
			}

			return value;
		});
	}
}

export default Point;
